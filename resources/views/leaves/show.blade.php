@extends('layouts.app')

@section('content')

<h1>Leave Request Details</h1>

<p>Status: {{ $leaveRequest->status }}</p>

<p>Leave Type: {{ $leaveRequest->leaveType->name }}</p>

<p>Start: {{ $leaveRequest->start_date }}</p>
<p>End: {{ $leaveRequest->end_date }}</p>

<p>Days: {{ $leaveRequest->days_requested }}</p>

<p>Reason: {{ $leaveRequest->reason }}</p>

@endsection