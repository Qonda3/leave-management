<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    /**
     * Display the employee dashboard with
     * leave balances, recent requests,
     * and pending leave statistics.
     */
    private function employeeDashboard($user)
    {
        $leaveBalances = $user->leaveBalances()->with('leaveType')->get();

        $recentRequests = $user->leaveRequests()
            ->with('leaveType')
            ->latest()
            ->take(5)
            ->get();

        $pendingCount = $user->leaveRequests()
            ->where('status', 'pending')
            ->count();

        return view('dashboard.employee', compact(
            'leaveBalances',
            'recentRequests',
            'pendingCount'
        ));

    }
}
