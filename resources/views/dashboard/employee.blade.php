@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')

{{-- Header --}}
<div class="mb-6">
    <h1 class="text-2xl font-bold">
        Welcome back, {{ auth()->user()->name }}
    </h1>
</div>

{{-- Stats --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">

    <div class="bg-white border p-4 rounded">
        <p>Pending Requests</p>
        <p class="text-2xl font-bold">
            {{ $pendingCount }}
        </p>
    </div>

    <div class="bg-white border p-4 rounded">
        <p>Leave Types</p>
        <p class="text-2xl font-bold">
            {{ $leaveBalances->count() }}
        </p>
    </div>

    <div class="bg-white border p-4 rounded">
        <p>Requests Made</p>
        <p class="text-2xl font-bold">
            {{ $recentRequests->count() }}
        </p>
    </div>

</div>


{{-- Leave Balances --}}
<div class="bg-white border rounded mb-8">

    <div class="p-4 border-b">
        <h2 class="font-semibold">
            Leave Balances
        </h2>
    </div>

    @forelse($leaveBalances as $balance)

        <div class="p-4 flex justify-between">

            <p>
                {{ $balance->leaveType->name }}
            </p>

            <p class="font-bold">
                {{ $balance->remaining_days }}
                days
            </p>

        </div>

    @empty

        <p class="p-4">
            No leave balances found.
        </p>

    @endforelse

</div>


{{-- Recent Requests --}}
<div class="bg-white border rounded">

    <div class="p-4 border-b">
        <h2 class="font-semibold">
            Recent Requests
        </h2>
    </div>

    @forelse($recentRequests as $request)

        <div class="p-4 flex justify-between">

            <div>
                <p>
                    {{ $request->leaveType->name }}
                </p>

                <p class="text-sm text-gray-500">
                    {{ $request->days_requested }}
                    days
                </p>
            </div>

            <span>
                {{ ucfirst($request->status) }}
            </span>

        </div>

    @empty

        <p class="p-4">
            No requests yet.
        </p>

    @endforelse

</div>

@endsection