<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Key;
use App\Models\KeyLog;
use App\Models\SecurityShift;
use Illuminate\Support\Facades\Auth;

class SecurityController extends Controller
{
    /**
     * Show the QR code scanner page
     */
    public function scan()
    {
        return view(''security.scan'');
    }

    /**
     * Verify a key using QR code
     */
    public function verifyKey(Request $request)
    {
        $request->validate([
            ''key_code'' => ''required|string'',
        ]);

        $key = Key::where(''code'', $request->key_code)->first();

        if (!$key) {
            return response()->json([
                ''success'' => false,
                ''message'' => ''Key not found''
            ], 404);
        }

        return response()->json([
            ''success'' => true,
            ''key'' => [
                ''code'' => $key->code,
                ''label'' => $key->label,
                ''status'' => $key->status,
                ''location'' => $key->location->name ?? ''Unknown'',
            ]
        ]);
    }

    /**
     * Show security shifts
     */
    public function shifts()
    {
        $user = Auth::user();
        $shifts = SecurityShift::where(''user_id'', $user->id)
            ->orderBy(''created_at'', ''desc'')
            ->paginate(10);

        return view(''security.shifts'', compact(''shifts''));
    }
}
