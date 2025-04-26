<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PresenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $today = Presence::where('user_id', auth()->id())
            ->whereDate('created_at', Carbon::today())
            ->first();
        
        return view('presence.index', compact('today'));
    }

    protected function store(Request $request)
    {
        $clientIp = $request->ip();
        $allowedIp = env('ALLOWED_ABSEN_IP');

        if ($clientIp !== $allowedIp) {
            return back()->with('error', 'Absensi hanya bisa dilakukan di jaringan Kost Ungu.');
        }

        $now = Carbon::now();
        $presence = Presence::where('user_id', auth()->id())
            ->whereDate('created_at', Carbon::today())
            ->first();

        if (!$presence) {
            // Check in
            $status = $now->hour >= 9 ? 'late' : 'present';
            Presence::create([
                'user_id' => auth()->id(),
                'check_in' => $now,
                'status' => $status,
                'ip_address' => $clientIp
            ]);
            $message = 'Check in berhasil.';
        } else {
            // Check out
            $presence->update([
                'check_out' => $now
            ]);
            $message = 'Check out berhasil.';
        }

        return back()->with('success', $message);
    }

    public function recap()
    {
        $month = request('month', Carbon::now()->month);
        $year = request('year', Carbon::now()->year);

        $presences = Presence::where('user_id', auth()->id())
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->latest()
            ->get();

        $leaveRequests = LeaveRequest::where('user_id', auth()->id())
            ->whereMonth('start_date', $month)
            ->whereYear('start_date', $year)
            ->latest()
            ->get();

        return view('presence.recap', compact('presences', 'leaveRequests', 'month', 'year'));
    }
}