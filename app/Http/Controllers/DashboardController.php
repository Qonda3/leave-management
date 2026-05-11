<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->isManager()) {
            return $this->managerDashboard();
        }

        return $this->employeeDashboard($user);
    }

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

    private function managerDashboard()
    {
        $peningRequests = LeaveRequest::with(['user', 'leaveType'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        $totalPending = $pendingRequests->count();
        $totalApproved = LeaveRequest::where('status', 'approved')->count();
        $totalDeclined = LeaveRequest::where('status', 'declined')->count();

        return view('dashboard.manager', compact(
            'pendingRequests',
            'totalPending',
            'totalApproved',
            'totalDeclined'
        ));
    }
}
