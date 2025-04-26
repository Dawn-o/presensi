<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $leaves = LeaveRequest::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('leaves.index', compact('leaves'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type' => 'required|in:sick,personal,other',
            'reason' => 'required|string'
        ]);

        LeaveRequest::create([
            'user_id' => auth()->id(),
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'type' => $validated['type'],
            'reason' => $validated['reason'],
            'status' => 'pending'
        ]);

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request submitted successfully.');
    }

    public function approve(LeaveRequest $leave)
    {
        // Check if user is admin
        if (!auth()->user()->is_admin) {
            return back()->with('error', 'Anda tidak memiliki akses untuk menyetujui izin.');
        }

        $leave->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now()
        ]);

        return back()->with('success', 'Izin berhasil disetujui.');
    }

    public function reject(LeaveRequest $leave)
    {
        // Check if user is admin
        if (!auth()->user()->is_admin) {
            return back()->with('error', 'Anda tidak memiliki akses untuk menolak izin.');
        }

        $leave->update([
            'status' => 'rejected',
            'rejected_by' => auth()->id(),
            'rejected_at' => now()
        ]);

        return back()->with('success', 'Izin telah ditolak.');
    }
}