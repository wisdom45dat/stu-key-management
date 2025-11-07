<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SecurityShift;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $currentShift = $user->current_shift;
        
return view('profile.show', compact('user', 'currentShift'));    public function edit()
    {
        $user = Auth::user();
        return view(''profile.edit'', compact(''user''));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            ''name'' => ''required|string|max:255'',
            ''email'' => ''required|email|unique:users,email,'' . $user->id,
        ]);

        $user->update($request->only(''name'', ''email''));

        return redirect()->route(''profile.show'')->with(''success'', ''Profile updated successfully.'');
    }

    public function activity()
    {
        $user = Auth::user();
        $activities = $user->keyLogs()->with(''key.location'')->latest()->paginate(10);
        
        return view(''profile.activity'', compact(''user'', ''activities''));
    }

    public function shifts()
    {
        $user = Auth::user();
        $shifts = $user->securityShifts()->latest()->paginate(10);
        
        return view(''profile.shifts'', compact(''user'', ''shifts''));
    }

    public function endShift(Request $request)
    {
        $user = Auth::user();
        $currentShift = $user->current_shift;

        if ($currentShift) {
            $currentShift->update([
                ''end_at'' => now(),
                ''notes'' => $request->input(''notes'', '''')
            ]);

            return redirect()->route(''dashboard'')->with(''success'', ''Shift ended successfully.'');
        }

        return redirect()->route(''dashboard'')->with(''error'', ''No active shift found.'');
    }
}
