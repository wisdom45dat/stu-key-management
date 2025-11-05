<?php

namespace App\Http\Controllers;

use App\Models\Key;
use App\Models\KeyLog;
use App\Models\HrStaff;
use App\Models\TemporaryStaff;
use App\Models\PermanentStaffManual;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KioskController extends Controller
{
    public function index(): View
    {
        return view('kiosk.index');
    }

    public function scan(): View
    {
        return view('kiosk.scan');
    }

    public function processScan(Request $request): RedirectResponse
    {
        // This would process QR code scans
        $keyCode = $request->input('key_code');
        $action = $request->input('action', 'checkout');
        
        $key = Key::where('code', $keyCode)->first();
        
        if (!$key) {
            return back()->with('error', 'Key not found.');
        }
        
        if ($action === 'checkout') {
            return redirect()->route('kiosk.checkout', $key);
        } else {
            return redirect()->route('kiosk.checkin', $key);
        }
    }

    public function checkoutForm(Key $key): View
    {
        return view('kiosk.checkout', compact('key'));
    }

    public function processCheckout(Request $request, Key $key): RedirectResponse
    {
        // Process key checkout
        $request->validate([
            'holder_type' => 'required|in:hr,perm_manual,temp',
            'holder_id' => 'required',
            'expected_return_at' => 'nullable|date',
        ]);
        
        // In a real implementation, you would create the key log here
        return redirect()->route('kiosk.index')->with('success', 'Key checked out successfully.');
    }

    public function checkinForm(Key $key): View
    {
        return view('kiosk.checkin', compact('key'));
    }

    public function processCheckin(Request $request, Key $key): RedirectResponse
    {
        // Process key checkin
        // In a real implementation, you would create the key log here
        return redirect()->route('kiosk.index')->with('success', 'Key checked in successfully.');
    }

    public function searchHolder(Request $request): View
    {
        $search = $request->input('search');
        $results = [];
        
        if ($search) {
            // Search across different holder types
            $hrStaff = HrStaff::where('name', 'like', "%{$search}%")
                ->orWhere('staff_id', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->limit(10)
                ->get();
                
            $tempStaff = TemporaryStaff::where('name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->limit(10)
                ->get();
                
            $permStaff = PermanentStaffManual::where('name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->limit(10)
                ->get();
                
            $results = compact('hrStaff', 'tempStaff', 'permStaff');
        }
        
        return view('kiosk.search-holder', compact('search', 'results'));
    }

    public function createTemporaryStaff(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'id_number' => 'nullable|string|max:50',
            'dept' => 'nullable|string|max:100',
        ]);
        
        TemporaryStaff::create($request->all());
        
        return back()->with('success', 'Temporary staff created successfully.');
    }

    public function createPermanentManualStaff(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'staff_id' => 'nullable|string|max:50',
            'dept' => 'nullable|string|max:100',
        ]);
        
        PermanentStaffManual::create([
            ...$request->all(),
            'added_by' => auth()->id(),
        ]);
        
        return back()->with('success', 'Permanent staff created successfully.');
    }
}
