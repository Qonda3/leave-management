@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold">
        Welcome back, {{ auth()->user()->name }}
    </h1>
</div>

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


<div class="bg-white border rounded mb-8">

    <div class="p-4 border-b">
        <h2 class="font-semibold">
            Leave Balances
        </h2>
    </div>

    @forelse($leaveBalances as $balance)

        <div class="p-4 flex justify-between">

            <div>
                <p>
                    {{ $balance->leaveType->name }}
                </p>

                <p class="text-sm text-gray-500">
                    {{ $balance->used_days }}
                    used of
                    {{ $balance->total_days }}
                </p>
            </div>

            <p class="font-bold">
                {{ $balance->remaining_days }}
                days
            </p>

        </div>

    @empty

        <p class="p-4 text-gray-500">
            No leave balances found.
        </p>

    @endforelse

</div>

@endsection