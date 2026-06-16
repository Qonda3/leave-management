@extends('layouts.app')

@section('title', 'My Leave Requests')

@section('content')

{{-- Header --}}
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">My Leave Requests</h1>
        <p class="text-gray-500 mt-1">Track all your leave applications.</p>
    </div>
    <a href="{{ route('leaves.create') }}"
       class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium
              hover:bg-indigo-700 transition-colors">
        + Apply for Leave
    </a>
</div>

{{-- Leave Requests Table --}}
<div class="bg-white rounded-xl border border-gray-200 shadow-sm">

    @forelse($leaveRequests as $request)
        <div class="px-6 py-4 flex items-center justify-between
                    border-b border-gray-50 last:border-0 hover:bg-gray-50 transition-colors">
            <div class="flex items-center gap-4">

                {{-- Status Indicator Dot --}}
                <div class="w-2 h-2 rounded-full flex-shrink-0
                    {{ $request->status === 'approved' ? 'bg-green-500' : '' }}
                    {{ $request->status === 'pending'  ? 'bg-yellow-400' : '' }}
                    {{ $request->status === 'declined' ? 'bg-red-500' : '' }}">
                </div>

                <div>
                    <p class="text-sm font-semibold text-gray-900">
                        {{ $request->leaveType->name }}
                    </p>
                    <p class="text-xs text-gray-400 mt-0.5">
                        {{ $request->start_date->format('d M Y') }}
                        —
                        {{ $request->end_date->format('d M Y') }}
                        ·
                        <span class="font-medium text-gray-600">
                            {{ $request->days_requested }}
                            {{ Str::plural('day', $request->days_requested) }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <span class="text-xs font-semibold px-3 py-1 rounded-full
                    {{ $request->status === 'approved' ? 'bg-green-100 text-green-700' : '' }}
                    {{ $request->status === 'pending'  ? 'bg-yellow-100 text-yellow-700' : '' }}
                    {{ $request->status === 'declined' ? 'bg-red-100 text-red-700' : '' }}">
                    {{ ucfirst($request->status) }}
                </span>
                <a href="{{ route('leaves.show', $request) }}"
                   class="text-xs text-indigo-600 hover:underline font-medium">
                    View →
                </a>
            </div>
        </div>

    @empty
        <div class="px-6 py-16 text-center">
            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-500">No leave requests yet</p>
            <p class="text-xs text-gray-400 mt-1">Your submitted applications will appear here</p>
            <a href="{{ route('leaves.create') }}"
               class="mt-4 inline-block text-sm text-indigo-600 font-medium hover:underline">
                Apply for your first leave →
            </a>
        </div>
    @endforelse

</div>

@endsection