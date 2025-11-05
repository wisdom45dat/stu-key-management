<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $recentActivity = $user->keyLogsAsReceiver()
            ->with(['key.location'])
            ->latest()
            ->limit(10)
            ->get();

        $currentShift = $user->current_shift;

        return view('profile.show', compact('user', 'recentActivity', 'currentShift'));
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'required|string|max:20',
            'avatar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($validated);

        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed',
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.show')
            ->with('success', 'Password updated successfully.');
    }

    public function activityLog()
    {
        $activity = auth()->user()->keyLogsAsReceiver()
            ->with(['key.location', 'holder'])
            ->latest()
            ->paginate(20);

        return view('profile.activity', compact('activity'));
    }

    public function shiftHistory()
    {
        $shifts = auth()->user()->securityShifts()
            ->latest()
            ->paginate(20);

        return view('profile.shift-history', compact('shifts'));
    }

    public function startShift(Request $request)
    {
        $user = auth()->user();

        if ($user->isOnShift()) {
            return redirect()->back()->with('error', 'You are already on an active shift.');
        }

        $user->securityShifts()->create([
            'start_at' => now(),
            'notes' => $request->notes,
        ]);

        return redirect()->route('profile.show')
            ->with('success', 'Shift started successfully.');
    }

    public function endShift(Request $request)
    {
        $user = auth()->user();
        $currentShift = $user->current_shift;

        if (!$currentShift) {
            return redirect()->back()->with('error', 'No active shift found.');
        }

        $currentShift->update([
            'end_at' => now(),
            'notes' => $currentShift->notes . "\n" . $request->notes,
        ]);

        return redirect()->route('profile.show')
            ->with('success', 'Shift ended successfully.');
    }
}
