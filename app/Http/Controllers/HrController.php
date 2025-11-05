<?php

namespace App\Http\Controllers;

use App\Models\HrStaff;
use App\Models\PermanentStaffManual;
use App\Models\KeyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\HrStaffImport;
use App\Imports\TemporaryStaffImport;
use Maatwebsite\Excel\Facades\Excel;

class HrController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_hr_staff' => HrStaff::count(),
            'active_hr_staff' => HrStaff::active()->count(),
            'total_manual_staff' => PermanentStaffManual::count(),
            'pending_discrepancies' => KeyLog::withDiscrepancy()->unverified()->count(),
        ];

        $recentDiscrepancies = KeyLog::withDiscrepancy()
            ->unverified()
            ->with(['key.location', 'receiver'])
            ->latest()
            ->limit(10)
            ->get();

        $recentManualAdditions = PermanentStaffManual::with('addedBy')
            ->latest()
            ->limit(10)
            ->get();

        return view('hr.dashboard', compact('stats', 'recentDiscrepancies', 'recentManualAdditions'));
    }

    public function hrStaffIndex(Request $request)
    {
        $query = HrStaff::query();

        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('dept') && $request->dept) {
            $query->where('dept', $request->dept);
        }

        $staff = $query->latest()->paginate(20);

        $departments = HrStaff::distinct()->pluck('dept')->filter();
        $statuses = ['active', 'inactive'];

        return view('hr.staff.index', compact('staff', 'departments', 'statuses'));
    }

    public function hrStaffShow(HrStaff $hrStaff)
    {
        $hrStaff->load('keyLogs.key.location', 'keyLogs.receiver');
        
        $currentKeys = $hrStaff->getCurrentHeldKeys();
        $keyHistory = $hrStaff->keyLogs()
            ->with(['key.location', 'receiver'])
            ->latest()
            ->paginate(10);

        return view('hr.staff.show', compact('hrStaff', 'currentKeys', 'keyHistory'));
    }

    public function importHrStaffForm()
    {
        return view('hr.import.hr-staff');
    }

    public function importHrStaff(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:10240',
            'update_existing' => 'boolean',
        ]);

        try {
            $import = new HrStaffImport($request->boolean('update_existing', true));
            Excel::import($import, $request->file('csv_file'));

            $imported = $import->getImportedCount();
            $updated = $import->getUpdatedCount();
            $errors = $import->getErrors();

            $message = "Import completed: {$imported} new records, {$updated} updated records.";

            if (!empty($errors)) {
                $message .= ' ' . count($errors) . ' errors occurred.';
                return redirect()->route('hr.import.form')
                    ->with('warning', $message)
                    ->with('import_errors', $errors);
            }

            return redirect()->route('hr.staff.index')
                ->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->route('hr.import.form')
                ->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    public function manualStaffIndex(Request $request)
    {
        $query = PermanentStaffManual::with('addedBy');

        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        $staff = $query->latest()->paginate(20);

        return view('hr.manual-staff.index', compact('staff'));
    }

    public function createManualStaff()
    {
        return view('hr.manual-staff.create');
    }

    public function storeManualStaff(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:permanent_staff_manual,phone',
            'staff_id' => 'nullable|string|max:50|unique:permanent_staff_manual,staff_id',
            'dept' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:1000',
        ]);

        PermanentStaffManual::create([
            ...$validated,
            'added_by' => auth()->id(),
        ]);

        return redirect()->route('hr.manual-staff.index')
            ->with('success', 'Manual staff record created successfully.');
    }

    public function discrepanciesIndex()
    {
        $discrepancies = KeyLog::withDiscrepancy()
            ->unverified()
            ->with(['key.location', 'receiver', 'holder'])
            ->latest()
            ->paginate(20);

        return view('hr.discrepancies.index', compact('discrepancies'));
    }

    public function resolveDiscrepancy(KeyLog $keyLog, Request $request)
    {
        $request->validate([
            'action' => 'required|in:verify,reject',
            'notes' => 'nullable|string|max:1000',
        ]);

        DB::transaction(function () use ($keyLog, $request) {
            if ($request->action === 'verify') {
                $keyLog->markAsVerified();
                $message = 'Discrepancy resolved and verified.';
            } else {
                $keyLog->update([
                    'notes' => $request->notes . ' [Rejected by HR]',
                    'discrepancy_reason' => $request->notes,
                ]);
                $message = 'Discrepancy marked as rejected.';
            }
        });

        return redirect()->route('hr.discrepancies.index')
            ->with('success', $message);
    }

    public function bulkResolveDiscrepancies(Request $request)
    {
        $request->validate([
            'log_ids' => 'required|array',
            'log_ids.*' => 'exists:key_logs,id',
            'action' => 'required|in:verify,reject',
        ]);

        $resolved = 0;
        
        foreach ($request->log_ids as $logId) {
            $log = KeyLog::find($logId);
            if ($log && $log->discrepancy && !$log->verified) {
                if ($request->action === 'verify') {
                    $log->markAsVerified();
                } else {
                    $log->update([
                        'discrepancy_reason' => 'Bulk rejected by HR',
                    ]);
                }
                $resolved++;
            }
        }

        return redirect()->route('hr.discrepancies.index')
            ->with('success', "{$resolved} discrepancies resolved successfully.");
    }
}
