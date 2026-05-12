@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')

{{-- Header --}}
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">
        Welcome back, {{ auth()->user()->name }} 👋
    </h1>
    <p class="text-gray-500 mt-1">Here is your leave overview for this year.</p>
</div>

{{-- Stats Row --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
    <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
        <p class="text-sm text-gray-500 font-medium">Pending Requests</p>
        <p class="text-3xl font-bold text-yellow-500 mt-1">{{ $pendingCount }}</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
        <p class="text-sm text-gray-500 font-medium">Leave Types Available</p>
        <p class="text-3xl font-bold text-indigo-600 mt-1">{{ $leaveBalances->count() }}</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
        <p class="text-sm text-gray-500 font-medium">Total Requests Made</p>
        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $recentRequests->count() }}</p>
    </div>
</div>

{{-- Leave Balances --}}
<div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-8">
    <div class="px-6 py-4 border-b border-gray-100">
        <h2 class="text-base font-semibold text-gray-900">Leave Balances</h2>
        <p class="text-sm text-gray-500">Your remaining days per leave type</p>
    </div>
    <div class="divide-y divide-gray-50">
        @forelse($leaveBalances as $balance)
            <div class="px-6 py-4 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-900">
                        {{ $balance->leaveType->name }}
                    </p>
                    <p class="text-xs text-gray-400 mt-0.5">
                        {{ $balance->used_days }} days used of {{ $balance->total_days }}
                    </p>
                </div>
                <div class="text-right">
                    <span class="text-lg font-bold
                        {{ $balance->remaining_days > 5 ? 'text-green-600' : 'text-red-500' }}">
                        {{ $balance->remaining_days }}
                    </span>
                    <span class="text-xs text-gray-400 ml-1">days left</span>
                </div>
            </div>
        @empty
            <p class="px-6 py-4 text-sm text-gray-400">No leave balances found.</p>
        @endforelse
    </div>
</div>

{{-- Recent Requests --}}
<div class="bg-white rounded-xl border border-gray-200 shadow-sm">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <div>
            <h2 class="text-base font-semibold text-gray-900">Recent Requests</h2>
            <p class="text-sm text-gray-500">Your last 5 leave applications</p>
        </div>
        <a href="{{ route('leaves.create') }}"
           class="text-sm bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors font-medium">
            + Apply for Leave
        </a>
    </div>

    @forelse($recentRequests as $request)
        <div class="px-6 py-4 flex items-center justify-between border-b border-gray-50 last:border-0">
            <div>
                <p class="text-sm font-medium text-gray-900">
                    {{ $request->leaveType->name }}
                </p>
                <p class="text-xs text-gray-400 mt-0.5">
                    {{ $request->start_date->format('d M Y') }}
                    —
                    {{ $request->end_date->format('d M Y') }}
                    · {{ $request->days_requested }} days
                </p>
            </div>
            <span class="text-xs font-semibold px-3 py-1 rounded-full
                {{ $request->status === 'approved' ? 'bg-green-100 text-green-700' : '' }}
                {{ $request->status === 'pending'  ? 'bg-yellow-100 text-yellow-700' : '' }}
                {{ $request->status === 'declined' ? 'bg-red-100 text-red-700' : '' }}">
                {{ ucfirst($request->status) }}
            </span>
        </div>
    @empty
        <div class="px-6 py-8 text-center">
            <p class="text-sm text-gray-400">You have not applied for any leave yet.</p>
            <a href="{{ route('leaves.create') }}"
               class="mt-3 inline-block text-sm text-indigo-600 font-medium hover:underline">
                Apply for your first leave →
            </a>
        </div>
    @endforelse
</div>

@endsection