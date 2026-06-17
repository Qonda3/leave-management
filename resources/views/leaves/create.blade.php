@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto">

    <h1 class="text-xl font-bold mb-4">Apply for Leave</h1>

    <form method="POST" action="{{ route('leaves.store') }}">
        @csrf

        {{-- Leave Type --}}
        <div>
            <label>Leave Type</label>
            <select name="leave_type_id">
                <option value="">Select</option>
                @foreach($leaveTypes as $type)
                    <option value="{{ $type->id }}"
                        {{ old('leave_type_id') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>

            @error('leave_type_id')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <br>

        {{-- Dates --}}
        <div>
            <label>Start Date</label>
            <input type="date" name="start_date" value="{{ old('start_date') }}">

            @error('start_date')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <div>
            <label>End Date</label>
            <input type="date" name="end_date" value="{{ old('end_date') }}">

            @error('end_date')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <br>

        {{-- Reason --}}
        <div>
            <label>Reason</label>
            <textarea name="reason">{{ old('reason') }}</textarea>

            @error('reason')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">Submit</button>
    </form>

</div>
@endsection