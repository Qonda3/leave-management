@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto">

    <a href="{{ route('leaves.index') }}">
        ← Back
    </a>

    <h1 class="text-xl font-bold mb-4">Leave Request Details</h1>

    <div>
        <p><strong>Status:</strong> {{ $leaveRequest->status }}</p>
        <p><strong>Leave Type:</strong> {{ $leaveRequest->leaveType->name }}</p>
        <p><strong>Start:</strong> {{ $leaveRequest->start_date }}</p>
        <p><strong>End:</strong> {{ $leaveRequest->end_date }}</p>
        <p><strong>Days:</strong> {{ $leaveRequest->days_requested }}</p>
        <p><strong>Reason:</strong> {{ $leaveRequest->reason }}</p>
    </div>

</div>

@endsection