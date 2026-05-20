@extends('layouts.app')

@section('title', 'My Leave Requests')

@section('content')

<div class="mb-6">

    <h1 class="text-2xl font-bold">
        My Leave Requests
    </h1>

    <p class="text-gray-500">
        Track your leave applications.
    </p>

</div>


<div class="bg-white border rounded">

    @forelse($leaveRequests as $request)

        <div class="p-4 border-b">

            <p>
                {{ $request->leaveType->name }}
            </p>

        </div>

    @empty

        <div class="p-4">
            <p>No leave requests yet.</p>
        </div>

    @endforelse

</div>

@endsection