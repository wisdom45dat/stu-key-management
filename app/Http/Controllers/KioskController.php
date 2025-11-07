<?php

namespace App\Http\Controllers;

use App\Models\Key;
use Illuminate\Http\Request;

class KioskController extends Controller
{
    public function index()
    {
        return view('kiosk.index');
    }

    public function checkout()
    {
        $availableKeys = Key::where('status', 'available')->orderBy('code')->get();
        return view('kiosk.checkout', compact('availableKeys'));
    }

    public function checkin()
    {
        $checkedOutKeys = Key::where('status', 'checked_out')->orderBy('code')->get();
        return view('kiosk.checkin', compact('checkedOutKeys'));
    }

    public function scan()
    {
        return view('kiosk.scan');
    }
}
