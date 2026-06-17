@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <h1 class="text-2xl font-bold">Apply for Leave</h1>

    {{-- Balance --}}
    <div class="bg-indigo-50 p-4 rounded-lg">
        <p class="font-semibold mb-2">Your balances</p>

        <div class="grid grid-cols-3 gap-2 text-sm">
            @foreach($leaveBalances as $balance)
                <div class="bg-white p-2 rounded border">
                    {{ $balance->leaveType->name }}:
                    <strong>{{ $balance->remaining_days }}</strong>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Form --}}
    <form method="POST" action="{{ route('leaves.store') }}"
          class="bg-white p-6 rounded-xl border space-y-4">
        @csrf

        {{-- Leave Type --}}
        <select name="leave_type_id" class="w-full border rounded px-3 py-2">
            <option value="">Select type</option>
            @foreach($leaveTypes as $type)
                <option value="{{ $type->id }}"
                    {{ old('leave_type_id') == $type->id ? 'selected' : '' }}>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>

        {{-- Dates --}}
        <div class="grid grid-cols-2 gap-4">
            <input type="date" id="start" name="start_date"
                   value="{{ old('start_date') }}"
                   class="border rounded px-3 py-2">

            <input type="date" id="end" name="end_date"
                   value="{{ old('end_date') }}"
                   class="border rounded px-3 py-2">
        </div>

        {{-- Live duration --}}
        <p id="preview" class="text-sm text-indigo-600 hidden"></p>

        {{-- Reason --}}
        <textarea name="reason"
                  class="w-full border rounded px-3 py-2"
                  rows="4">{{ old('reason') }}</textarea>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded">
            Submit
        </button>
    </form>
</div>

<script>
const s = document.getElementById('start');
const e = document.getElementById('end');
const p = document.getElementById('preview');

function calc() {
    if (!s.value || !e.value) return p.classList.add('hidden');

    const diff = (new Date(e.value) - new Date(s.value)) / 86400000 + 1;

    if (diff > 0) {
        p.textContent = `${diff} day(s) selected`;
        p.classList.remove('hidden');
    } else {
        p.classList.add('hidden');
    }
}

s.addEventListener('change', calc);
e.addEventListener('change', calc);
</script>
@endsection