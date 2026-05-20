<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaveRequests = auth()->user()
            ->leaveRequests()
            ->with('leaveType')
            ->latest()
            ->get();

        return view('leaves.index', compact('leaveRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leaveTypes = LeaveType::all();
        $leaveBalances = auth()->user()
            ->leaveBalances()
            ->with('leaveType')
            ->get();

        return view('leaves.create', compact('leaveTypes', 'leaveBalances'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date'   => ['required', 'date', 'after_or_equal:start_date'],
            'reason'     => ['required', 'string', 'min:10'],
        ]);

        $startDate     = \Carbon\Carbon::parse($validated['start_date']);
        $endDate       = \Carbon\Carbon::parse($validated['end_date']);
        $daysRequested = $startDate->diffInDays($endDate) + 1;

        $balance = $user->leaveBalances()
            ->where('leave_type_id', $validated['leave_type_id'])
            ->first();

        if (!$balance || $balance->remaining_days < $daysRequested){
        }

        $overlap = $user->leaveRequests()
            ->where('status', '!=', 'declined');

        LeaveRequest::create([
            'user_id'       => $user->id,
            'leave_type_id' => $validated['leave_type_id'],
            'start_date'    => $validated['start_date'],
            'end_date'      => $validated['end_date'],
            'days_requested'=> $daysRequested,
            'reason'        => $validated['reason'],
            'status'        => 'pending',
        ]);

        return redirect()
            ->route('leaves.index')
            ->with('success', 'Leave request submitted successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
