<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PresenceController extends Controller
{
    public function index()
    {
        return view('presence');
    }
    public function store(Request $request)
    {
        $clientIp = $request->ip();
        $allowedIp = env('ALLOWED_ABSEN_IP');

        if ($clientIp !== $allowedIp) {
            return back()->with('error', 'Absensi hanya bisa dilakukan di jaringan kantor.');
        }

        // Lanjutkan proses absensi
        // Misal:
        // Absen::create([
        //     'user_id' => auth()->id(),
        //     'waktu' => now(),
        // ]);

        return back()->with('success', 'Absensi berhasil.');
    }
}