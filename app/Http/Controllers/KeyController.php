<?php

namespace App\Http\Controllers;

use App\Models\Key;
use App\Models\KeyLog;
use Illuminate\Http\Request;

class KeyController extends Controller
{
    public function index()
    {
        $keys = Key::with(['location', 'latestLog'])
            ->latest()
            ->paginate(10);

        $availableCount = Key::where('status', 'available')->count();
        $checkedOutCount = Key::where('status', 'checked_out')->count();

        return view('keys.index', compact('keys', 'availableCount', 'checkedOutCount'));
    }

    public function create()
    {
        // Return create view
        return view('keys.create');
    }

    public function store(Request $request)
    {
        // Store new key logic
    }

    public function show(Key $key)
    {
        // Show key details
        return view('keys.show', compact('key'));
    }

    public function edit(Key $key)
    {
        // Edit key
        return view('keys.edit', compact('key'));
    }

    public function update(Request $request, Key $key)
    {
        // Update key logic
    }

    public function destroy(Key $key)
    {
        // Delete key logic
    }

    public function checkout(Key $key)
    {
        // Checkout key logic
        return view('keys.checkout', compact('key'));
    }

    public function checkin(Key $key)
    {
        // Checkin key logic
        return view('keys.checkin', compact('key'));
    }
}
