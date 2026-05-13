@extends('layouts.app')

@section('title', 'Manager Dashboard')

@section('content')

{{-- Header --}}
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">
        Manager Dashboard 📋
    </h1>
    <p class="text-gray-500 mt-1">Review and manage employee leave requests.</p>
</div>

{{-- Stats Row --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
    <div class="bg-white rounded-xl border border-yellow-200 p-5 shadow-sm">
        <p class="text-sm text-gray-500 font-medium">Pending Review</p>
        <p class="text-3xl font-bold text-yellow-500 mt-1">{{ $totalPending }}</p>
    </div>
    <div class="bg-white rounded-xl border border-green-200 p-5 shadow-sm">
        <p class="text-sm text-gray-500 font-medium">Approved</p>
        <p class="text-3xl font-bold text-green-600 mt-1">{{ $totalApproved }}</p>
    </div>
    <div class="bg-white rounded-xl border border-red-200 p-5 shadow-sm">
        <p class="text-sm text-gray-500 font-medium">Declined</p>
        <p class="text-3xl font-bold text-red-500 mt-1">{{ $totalDeclined }}</p>
    </div>
</div>

{{-- Pending Requests Table --}}
<div class="bg-white rounded-xl border border-gray-200 shadow-sm">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <div>
            <h2 class="text-base font-semibold text-gray-900">Pending Leave Requests</h2>
            <p class="text-sm text-gray-500">Requests waiting for your decision</p>
        </div>
        <a href="{{ route('manager.approvals') }}"
           class="text-sm text-indigo-600 font-medium hover:underline">
            View all →
        </a>
    </div>

    @forelse($pendingRequests as $request)
        <div class="px-6 py-4 flex items-center justify-between border-b border-gray-50 last:border-0">
            <div>
                <p class="text-sm font-medium text-gray-900">{{ $request->user->name }}</p>
                <p class="text-xs text-gray-400 mt-0.5">
                    {{ $request->leaveType->name }}
                    ·
                    {{ $request->start_date->format('d M Y') }}
                    —
                    {{ $request->end_date->format('d M Y') }}
                    · {{ $request->days_requested }} days
                </p>
            </div>
            <div class="flex items-center gap-2">
                <form method="POST" action="{{ route('manager.approve', $request) }}">
                    @csrf @method('PATCH')
                    <button class="text-xs bg-green-600 text-white px-3 py-1.5 rounded-lg
                                   hover:bg-green-700 transition-colors font-medium">
                        Approve
                    </button>
                </form>
                <form method="POST" action="{{ route('manager.decline', $request) }}">
                    @csrf @method('PATCH')
                    <button class="text-xs bg-red-500 text-white px-3 py-1.5 rounded-lg
                                   hover:bg-red-600 transition-colors font-medium">
                        Decline
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="px-6 py-8 text-center">
            <p class="text-sm text-gray-400">No pending requests. You are all caught up ✅</p>
        </div>
    @endforelse
</div>

@endsection