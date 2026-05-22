@extends('layouts.app')

@section('title', 'My Leave Requests')

@section('content')

@empty

    <div class="p-8 text-center">

        <p>No leave requests yet.</p>

        <a href="{{ route('leaves.create') }}">
            Apply for your first leave
        </a>

    </div>

@endforelse


<div class="bg-white border rounded">

    @forelse($leaveRequests as $request)

        <div class="p-4 flex justify-between border-b">

            <div class="w-2 h-2 rounded-full flex-shrink-0
                {{ $request->status === 'approved' ? 'bg-green-500' : '' }}
                {{ $request->status === 'pending'  ? 'bg-yellow-400' : '' }}
                {{ $request->status === 'declined' ? 'bg-red-500' : '' }}">
            </div>

            <div>

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

            <div class="flex items-center gap-3">

                <span class="text-xs font-semibold px-3 py-1 rounded-full
                    {{ $request->status === 'approved' ? 'bg-green-100 text-green-700' : '' }}
                    {{ $request->status === 'pending'  ? 'bg-yellow-100 text-yellow-700' : '' }}
                    {{ $request->status === 'declined' ? 'bg-red-100 text-red-700' : '' }}">
                    {{ ucfirst($request->status) }}
                </span>

                <a href="{{ route('leaves.show', $request) }}">
                    View
                </a>
                
            </div>

        </div>

    @empty

        <div class="p-4">
            <p>No leave requests yet.</p>
        </div>

    @endforelse

</div>

@endsection