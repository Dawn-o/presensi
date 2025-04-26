<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Presence;
use App\Models\LeaveRequest;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class RecapController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now('Asia/Makassar');
        $month = $request->input('month', $now->month);
        $year = $request->input('year', $now->year);
        $userId = $request->input('user_id');

        // If admin and user_id provided, show that user's recap
        if (auth()->user()->is_admin && $userId) {
            $user = User::findOrFail($userId);
        } else {
            $user = auth()->user();
        }

        // Create date period for the month
        $startOfMonth = Carbon::create($year, $month, 1, 0, 0, 0, 'Asia/Makassar');
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        $period = CarbonPeriod::create($startOfMonth, $endOfMonth);

        // Get all presences for the month
        $presences = $user->presences()
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get()
            ->keyBy(function($presence) {
                return $presence->created_at->format('Y-m-d');
            });

        // Create monthly calendar
        $monthlyCalendar = collect($period)->map(function($date) use ($presences) {
            return [
                'date' => $date,
                'presence' => $presences->get($date->format('Y-m-d'))
            ];
        });

        // Get user list for admin
        $users = auth()->user()->is_admin ? User::where('is_admin', false)->get() : null;

        // Get leave requests for the month
        $leaveRequests = LeaveRequest::where('user_id', $user->id)
            ->whereMonth('start_date', $month)
            ->whereYear('start_date', $year)
            ->latest()
            ->paginate(10);

        return view('presence.recap', compact(
            'monthlyCalendar',
            'month',
            'year',
            'users',
            'user',
            'leaveRequests'
        ));
    }
}