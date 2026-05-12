@extends('layouts.app')

@section('title', 'Manager Dashboard')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold">
        Manager Dashboard
    </h1>

    <p class="text-gray-500">
        Review employee leave requests.
    </p>
</div>


<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

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

@endsection