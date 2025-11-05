<?php

namespace App\Http\Controllers;

use App\Models\KeyLog;
use App\Models\Key;
use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function keyActivity(Request $request)
    {
        $filters = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'key_id' => 'nullable|exists:keys,id',
            'location_id' => 'nullable|exists:locations,id',
            'receiver_id' => 'nullable|exists:users,id',
            'action' => 'nullable|in:checkout,checkin',
        ]);

        $query = KeyLog::with(['key.location', 'receiver', 'holder'])
            ->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);

        if (!empty($filters['key_id'])) {
            $query->where('key_id', $filters['key_id']);
        }

        if (!empty($filters['location_id'])) {
            $query->whereHas('key', function ($q) use ($filters) {
                $q->where('location_id', $filters['location_id']);
            });
        }

        if (!empty($filters['receiver_id'])) {
            $query->where('receiver_user_id', $filters['receiver_id']);
        }

        if (!empty($filters['action'])) {
            $query->where('action', $filters['action']);
        }

        $logs = $query->latest()->paginate(50);

        $keys = Key::all();
        $locations = Location::all();
        $receivers = User::role('security')->get();

        return view('reports.key-activity', compact('logs', 'filters', 'keys', 'locations', 'receivers'));
    }

    public function currentHolders()
    {
        $currentHolders = KeyLog::openCheckouts()
            ->with(['key.location', 'holder', 'receiver'])
            ->latest()
            ->paginate(50);

        return view('reports.current-holders', compact('currentHolders'));
    }

    public function overdueKeys()
    {
        $overdueKeys = KeyLog::overdue()
            ->with(['key.location', 'holder', 'receiver'])
            ->latest()
            ->paginate(50);

        return view('reports.overdue-keys', compact('overdueKeys'));
    }

    public function staffActivity(Request $request)
    {
        $filters = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'staff_type' => 'nullable|in:hr,perm_manual,temp',
        ]);

        $query = KeyLog::with(['key.location', 'receiver'])
            ->whereBetween('created_at', [$filters['start_date'], $filters['end_date']])
            ->where('action', 'checkout');

        if (!empty($filters['staff_type'])) {
            $query->where('holder_type', $filters['staff_type']);
        }

        $staffActivity = $query->select(
                'holder_type',
                'holder_id',
                'holder_name',
                'holder_phone',
                DB::raw('COUNT(*) as total_checkouts'),
                DB::raw('AVG(TIMESTAMPDIFF(MINUTE, created_at, 
                    (SELECT created_at FROM key_logs AS k2 
                     WHERE k2.returned_from_log_id = key_logs.id)
                )) as avg_duration_minutes')
            )
            ->groupBy('holder_type', 'holder_id', 'holder_name', 'holder_phone')
            ->orderBy('total_checkouts', 'desc')
            ->paginate(50);

        return view('reports.staff-activity', compact('staffActivity', 'filters'));
    }

    public function securityPerformance(Request $request)
    {
        $filters = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $performance = User::role('security')
            ->withCount(['keyLogsAsReceiver as total_transactions' => function($query) use ($filters) {
                $query->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
            }])
            ->withCount(['keyLogsAsReceiver as checkout_count' => function($query) use ($filters) {
                $query->where('action', 'checkout')
                      ->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
            }])
            ->withCount(['keyLogsAsReceiver as checkin_count' => function($query) use ($filters) {
                $query->where('action', 'checkin')
                      ->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
            }])
            ->having('total_transactions', '>', 0)
            ->orderBy('total_transactions', 'desc')
            ->paginate(20);

        return view('reports.security-performance', compact('performance', 'filters'));
    }

    public function analyticsDashboard()
    {
        $today = now()->format('Y-m-d');
        $weekAgo = now()->subDays(7)->format('Y-m-d');

        // Basic stats
        $stats = [
            'today_checkouts' => KeyLog::whereDate('created_at', $today)
                ->where('action', 'checkout')
                ->count(),
            'week_checkouts' => KeyLog::whereDate('created_at', '>=', $weekAgo)
                ->where('action', 'checkout')
                ->count(),
            'avg_checkout_duration' => KeyLog::checkin()
                ->whereDate('created_at', '>=', $weekAgo)
                ->average(DB::raw('TIMESTAMPDIFF(MINUTE, 
                    (SELECT created_at FROM key_logs AS k2 WHERE k2.id = key_logs.returned_from_log_id),
                    key_logs.created_at)')),
            'busiest_location' => Location::withCount(['keyLogs as recent_checkouts' => function($query) use ($weekAgo) {
                $query->where('action', 'checkout')
                      ->whereDate('created_at', '>=', $weekAgo);
            }])->orderBy('recent_checkouts', 'desc')
               ->first(),
        ];

        // Hourly activity for today
        $hourlyActivity = KeyLog::whereDate('created_at', $today)
            ->where('action', 'checkout')
            ->select(
                DB::raw('HOUR(created_at) as hour'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('hour')
            ->orderBy('hour')
            ->get()
            ->pluck('count', 'hour');

        // Top keys this week
        $topKeys = Key::withCount(['keyLogs as recent_checkouts' => function($query) use ($weekAgo) {
                $query->where('action', 'checkout')
                      ->whereDate('created_at', '>=', $weekAgo);
            }])
            ->orderBy('recent_checkouts', 'desc')
            ->limit(10)
            ->get();

        return view('reports.analytics', compact('stats', 'hourlyActivity', 'topKeys'));
    }

    public function exportKeyActivity(Request $request)
    {
        $filters = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'format' => 'required|in:csv,excel,pdf',
        ]);

        $logs = KeyLog::with(['key.location', 'receiver', 'holder'])
            ->whereBetween('created_at', [$filters['start_date'], $filters['end_date']])
            ->latest()
            ->get();

        if ($filters['format'] === 'csv') {
            return $this->exportToCsv($logs);
        } elseif ($filters['format'] === 'excel') {
            return $this->exportToExcel($logs);
        } else {
            return $this->exportToPdf($logs, $filters);
        }
    }

    private function exportToCsv($logs)
    {
        $fileName = 'key-activity-' . now()->format('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($logs) {
            $file = fopen('php://output', 'w');
            
            // Headers
            fputcsv($file, [
                'Date', 'Time', 'Action', 'Key Code', 'Key Label', 'Location',
                'Holder Name', 'Holder Phone', 'Holder Type', 'Security Officer',
                'Expected Return', 'Verified', 'Discrepancy'
            ]);

            // Data
            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->created_at->format('Y-m-d'),
                    $log->created_at->format('H:i:s'),
                    $log->action,
                    $log->key->code,
                    $log->key->label,
                    $log->key->location->full_address,
                    $log->holder_name,
                    $log->holder_phone,
                    $log->holder_type_label,
                    $log->receiver_name,
                    $log->expected_return_at ? $log->expected_return_at->format('Y-m-d H:i') : 'N/A',
                    $log->verified ? 'Yes' : 'No',
                    $log->discrepancy ? 'Yes' : 'No',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportToExcel($logs)
    {
        // Implementation for Excel export
        // This would use Maatwebsite/Excel package
        return response()->json(['message' => 'Excel export to be implemented']);
    }

    private function exportToPdf($logs, $filters)
    {
        // Implementation for PDF export
        // This would use DomPDF or similar
        return response()->json(['message' => 'PDF export to be implemented']);
    }
}
