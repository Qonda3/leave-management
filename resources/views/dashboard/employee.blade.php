@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')

<div>
    <h1>
        Welcome back, {{ auth()->user()->name }}
    </h1>
</div>

@endsection