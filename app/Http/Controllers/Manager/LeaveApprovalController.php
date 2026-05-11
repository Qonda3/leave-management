<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveApprovalController extends Controller
{
    public function index()
    {
        $pendingRequests = LeaveRequest::with(['user', 'leaveType'])
            ->where('status', 'pending')
            ->latest()
            ->get();
        
        return view('manager.approvals', compact('pendingRequests'));
    }

    public function approve(Request $request, LeaveRequest $leaveRequest)
    {
        return back()->with('success', 'Leave approved');
    }

    public function decline(Request $request, LeaveRequest $leaveRequest)
    {
        return back()->with('success', 'Leave declined.');
    }
}
