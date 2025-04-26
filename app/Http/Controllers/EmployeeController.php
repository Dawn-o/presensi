<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function index()
    {
        $today = Carbon::now('Asia/Makassar')->toDateString();
        
        $employees = User::where('is_admin', false)
            ->with(['presences' => function($query) use ($today) {
                $query->whereDate('created_at', $today);
            }])
            ->get();

        return view('employees.index', compact('employees'));
    }
}