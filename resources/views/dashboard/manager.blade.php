@extends('layouts.app')

@section('title', 'Manager Dashboard')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold">
        Manager Dashboard
    </h1>
</div>


<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">

    <div class="bg-white border p-4 rounded">
        <p>Pending Review</p>
        <p class="text-2xl font-bold">
            {{ $totalPending }}
        </p>
    </div>

    <div class="bg-white border p-4 rounded">
        <p>Approved</p>
        <p class="text-2xl font-bold">
            {{ $totalApproved }}
        </p>
    </div>

    <div class="bg-white border p-4 rounded">
        <p>Declined</p>
        <p class="text-2xl font-bold">
            {{ $totalDeclined }}
        </p>
    </div>

</div>


<div class="bg-white border rounded">

    <div class="p-4 border-b">
        <h2 class="font-semibold">
            Pending Requests
        </h2>
    </div>


    @forelse($pendingRequests as $request)

    <div class="p-4 flex justify-between">

        <div>

            <p>
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
        <div class="flex gap-2">

            <form method="POST"
                action="{{ route('manager.approve', $request) }}">

                @csrf
                @method('PATCH')

                <button>
                    Approve
                </button>

            </form>


            <form method="POST"
                action="{{ route('manager.decline', $request) }}">

                @csrf
                @method('PATCH')

                <button>
                    Decline
                </button>

            </form>

        </div>

    </div>

@endforelse

</div>

@endsection