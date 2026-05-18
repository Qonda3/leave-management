@extends('layouts.app')

@section('title', 'Leave Approvals')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold">
        Leave Approvals
    </h1>

    <p class="text-gray-500">
        Review employee leave requests.
    </p>
</div>


<div class="bg-white border rounded">

    @forelse($pendingRequests as $request)

        <div class="p-4 border-b">

            <p class="font-medium">
                {{ $request->user->name }}
            </p>


            <p class="text-sm text-gray-500">

                {{ $request->leaveType->name }}

                ·

                {{ $request->start_date->format('d M Y') }}

                -

                {{ $request->end_date->format('d M Y') }}

                ·

                {{ $request->days_requested }} days

            </p>

        </div>

    @empty

        <div class="p-4">
            <p>No pending requests.</p>
        </div>

    @endforelse

</div>

@endsection