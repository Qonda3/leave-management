@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto space-y-6">

    <h1 class="text-2xl font-bold text-gray-900">Apply for Leave</h1>

    <form method="POST" action="{{ route('leaves.store') }}"
          class="bg-white p-6 rounded-xl border space-y-5">
        @csrf

        {{-- Leave Type --}}
        <div>
            <label class="block text-sm font-medium mb-1">Leave Type</label>

            <select name="leave_type_id"
                class="w-full border rounded-lg px-3 py-2">

                <option value="">Select</option>

                @foreach($leaveTypes as $type)
                    <option value="{{ $type->id }}"
                        {{ old('leave_type_id') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>

            @error('leave_type_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Dates --}}
        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="block text-sm mb-1">Start</label>
                <input type="date" name="start_date"
                       value="{{ old('start_date') }}"
                       class="w-full border rounded-lg px-3 py-2">

                @error('start_date')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm mb-1">End</label>
                <input type="date" name="end_date"
                       value="{{ old('end_date') }}"
                       class="w-full border rounded-lg px-3 py-2">

                @error('end_date')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Reason --}}
        <div>
            <label class="block text-sm mb-1">Reason</label>
            <textarea name="reason"
                      class="w-full border rounded-lg px-3 py-2"
                      rows="4">{{ old('reason') }}</textarea>

            @error('reason')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg">
            Submit
        </button>

    </form>
</div>
@endsection