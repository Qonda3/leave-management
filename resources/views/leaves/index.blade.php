@extends('layouts.app')

@section('title', 'My Leave Requests')

@section('content')

<div class="mb-6">

    <h1 class="text-2xl font-bold">
        My Leave Requests
    </h1>

</div>


<div class="bg-white border rounded">

    @forelse($leaveRequests as $request)

        <div class="p-4 border-b">

            <p class="font-medium">
                {{ $request->leaveType->name }}
            </p>


            <p class="text-sm text-gray-500">

                {{ $request->start_date->format('d M Y') }}

                -

                {{ $request->end_date->format('d M Y') }}

                ·

                {{ $request->days_requested }} days

            </p>

        </div>

    @empty

        <div class="p-4">
            <p>No leave requests yet.</p>
        </div>

    @endforelse

</div>

@endsection