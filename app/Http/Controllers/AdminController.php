<?php

namespace App\Http\Controllers;

use App\Models\Key;
use App\Models\KeyLog;
use App\Models\HrStaff;
use App\Models\Location;
use App\Models\SecurityShift;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        
        // Role-based dashboard routing
        if ($user->hasRole('admin')) {
            return $this->adminDashboard();
        } elseif ($user->hasRole('security')) {
            return $this->securityDashboard();
        } elseif ($user->hasRole('hr')) {
            return $this->hrDashboard();
        }
        
        // Fallback to admin dashboard
        return $this->adminDashboard();
    }

    private function adminDashboard()
    {
        $stats = [
            'total_keys' => Key::count(),
            'available_keys' => Key::where('status', 'available')->count(),
            'checked_out_keys' => Key::where('status', 'checked_out')->count(),
            'active_staff' => HrStaff::where('status', 'active')->count(),
            'total_locations' => Location::count(),
            'today_checkouts' => KeyLog::whereDate('created_at', today())->where('action', 'checkout')->count(),
            'today_checkins' => KeyLog::whereDate('created_at', today())->where('action', 'checkin')->count(),
            'overdue_keys' => KeyLog::where('action', 'checkout')
                                ->whereNull('returned_from_log_id')
                                ->where('expected_return_at', '<', now())
                                ->count(),
        ];

        $recentLogs = KeyLog::with(['key', 'key.location', 'receiver'])
            ->latest()
            ->limit(10)
            ->get();

        return view('dashboard.admin', compact('stats', 'recentLogs'));
    }

    private function securityDashboard()
    {
        $user = auth()->user();
        $currentShift = $user->current_shift;
        
        $stats = [
            'today_checkouts' => KeyLog::whereDate('created_at', today())
                                ->where('receiver_user_id', $user->id)
                                ->where('action', 'checkout')
                                ->count(),
            'today_checkins' => KeyLog::whereDate('created_at', today())
                                ->where('receiver_user_id', $user->id)
                                ->where('action', 'checkin')
                                ->count(),
            'current_shift_duration' => $currentShift ? now()->diffInMinutes($currentShift->start_at) : 0,
            'available_keys' => Key::where('status', 'available')->count(),
            'shift_checkouts' => $currentShift ? 
                                KeyLog::where('receiver_user_id', $user->id)
                                    ->where('action', 'checkout')
                                    ->whereBetween('created_at', [$currentShift->start_at, now()])
                                    ->count() : 0,
        ];

        $myRecentActivity = KeyLog::with(['key', 'key.location'])
            ->where('receiver_user_id', $user->id)
            ->latest()
            ->limit(10)
            ->get();

        $availableKeys = Key::with('location')
            ->where('status', 'available')
            ->orderBy('code')
            ->limit(20)
            ->get();

        return view('dashboard.security', compact('stats', 'myRecentActivity', 'availableKeys', 'currentShift'));
    }

    private function hrDashboard()
    {
        $stats = [
            'total_staff' => HrStaff::count(),
            'active_staff' => HrStaff::where('status', 'active')->count(),
            'staff_with_keys' => KeyLog::where('action', 'checkout')
                                ->whereNull('returned_from_log_id')
                                ->distinct('holder_id')
                                ->count('holder_id'),
            'pending_discrepancies' => KeyLog::where('discrepancy', true)
                                        ->where('verified', false)
                                        ->count(),
            'today_checkouts' => KeyLog::whereDate('created_at', today())
                                ->where('action', 'checkout')
                                ->count(),
            'today_checkins' => KeyLog::whereDate('created_at', today())
                                ->where('action', 'checkin')
                                ->count(),
            'departments' => HrStaff::distinct('dept')->count('dept'),
            'total_transactions' => KeyLog::whereDate('created_at', today())->count(),
        ];

        $recentStaffActivity = KeyLog::with(['key', 'key.location', 'holder'])
            ->whereHas('key')
            ->latest()
            ->limit(10)
            ->get();

        $staffWithKeys = HrStaff::whereHas('keyLogs', function($query) {
            $query->where('action', 'checkout')
                  ->whereNull('returned_from_log_id');
        })->withCount(['keyLogs as current_keys_count' => function($query) {
            $query->where('action', 'checkout')
                  ->whereNull('returned_from_log_id');
        }])->limit(10)->get();

        return view('dashboard.hr', compact('stats', 'recentStaffActivity', 'staffWithKeys'));
    }

    // ... keep your other existing methods ...
}
