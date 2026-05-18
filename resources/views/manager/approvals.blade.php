@extends('layouts.app')

@section('title', 'Leave Approvals')

@section('content')

<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Leave Approvals</h1>
    <p class="text-gray-500 mt-1">All pending employee leave requests.</p>
</div>

<div class="bg-white rounded-xl border border-gray-200 shadow-sm">
    @forelse($pendingRequests as $request)
        <div class="px-6 py-4 flex items-center justify-between border-b border-gray-50 last:border-0">
            <div>
                <p class="text-sm font-medium text-gray-900">{{ $request->user->name }}</p>
                <p class="text-xs text-gray-400 mt-0.5">
                    {{ $request->leaveType->name }} ·
                    {{ $request->start_date->format('d M Y') }} —
                    {{ $request->end_date->format('d M Y') }} ·
                    {{ $request->days_requested }} days
                </p>
                @if($request->reason)
                    <p class="text-xs text-gray-500 mt-1 italic">"{{ $request->reason }}"</p>
                @endif
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
            <p class="text-sm text-gray-400">No pending requests. All caught up ✅</p>
        </div>
    @endforelse
</div>

@endsection