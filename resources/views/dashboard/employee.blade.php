@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold">
        Welcome back, {{ auth()->user()->name }}
    </h1>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

    <div class="bg-white border p-4 rounded">
        <p class="text-sm text-gray-500">Pending Requests</p>
        <p class="text-2xl font-bold">
            {{ $pendingCount }}
        </p>
    </div>

    <div class="bg-white border p-4 rounded">
        <p class="text-sm text-gray-500">Leave Types</p>
        <p class="text-2xl font-bold">
            {{ $leaveBalances->count() }}
        </p>
    </div>

    <div class="bg-white border p-4 rounded">
        <p class="text-sm text-gray-500">Requests Made</p>
        <p class="text-2xl font-bold">
            {{ $recentRequests->count() }}
        </p>
    </div>

</div>

@endsection