@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto">

    <h1>Apply for Leave</h1>

    <form method="POST" action="{{ route('leaves.store') }}">
        @csrf

        <label>Leave Type</label>
        <select name="leave_type_id">
            <option value="">Select</option>
            @foreach($leaveTypes as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>

        <br><br>

        <label>Start Date</label>
        <input type="date" name="start_date">

        <br><br>

        <label>End Date</label>
        <input type="date" name="end_date">

        <br><br>

        <label>Reason</label>
        <textarea name="reason"></textarea>

        <br><br>

        <button type="submit">Submit</button>
    </form>

</div>
@endsection