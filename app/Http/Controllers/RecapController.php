<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Presence;
use App\Models\LeaveRequest;
use Carbon\Carbon;
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

        $presences = Presence::where('user_id', $user->id)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->latest()
            ->paginate(10);

        $leaveRequests = LeaveRequest::where('user_id', $user->id)
            ->whereMonth('start_date', $month)
            ->whereYear('start_date', $year)
            ->latest()
            ->paginate(10);

        // Get all users for admin selection
        $users = auth()->user()->is_admin ? User::where('is_admin', false)->get() : null;

        return view('presence.recap', compact('presences', 'leaveRequests', 'month', 'year', 'users', 'user'));
    }
}