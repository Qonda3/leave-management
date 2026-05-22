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

                <span>
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