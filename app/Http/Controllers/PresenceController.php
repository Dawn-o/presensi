<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class PresenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Set timezone to WITA
        config(['app.timezone' => 'Asia/Makassar']);
    }

    public function index()
    {
        $user = auth()->user();
        $today = $user->presences()
            ->whereDate('created_at', now('Asia/Makassar'))
            ->first();

        $now = Carbon::now('Asia/Makassar');
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();
        
        // Get all dates of current month
        $period = CarbonPeriod::create($startOfMonth, $endOfMonth);
        
        // Get all presences for current month
        $presences = $user->presences()
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->get()
            ->keyBy(function($presence) {
                return $presence->created_at->format('Y-m-d');
            });

        // Create monthly calendar with presence data
        $monthlyCalendar = collect($period)->map(function($date) use ($presences) {
            return [
                'date' => $date,
                'presence' => $presences->get($date->format('Y-m-d'))
            ];
        });

        return view('presence.index', compact('today', 'monthlyCalendar'));
    }

    protected function store(Request $request)
    {
        $clientIp = $request->ip(); 
        $allowedIp = env('ALLOWED_ABSEN_IP');

        if ($clientIp !== $allowedIp) {
            return back()->with('error', 'Absensi hanya bisa dilakukan di jaringan Kost Ungu.');
        }

        $now = Carbon::now('Asia/Makassar');
        $presence = Presence::where('user_id', auth()->id())
            ->whereDate('created_at', $now->toDateString())
            ->first();

        if (!$presence) {
            // Check in
            $status = $now->hour >= 8 ? 'late' : 'present';
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
}