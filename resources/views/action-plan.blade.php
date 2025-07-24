@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-8 bg-white shadow-lg rounded-2xl border border-gray-100">

    {{-- Title --}}
    <div class="text-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Your Next 3 Power Moves</h2>
        <p class="text-gray-600 mt-2 text-base">
            Small actions, big impact. Start taking action now to grow your business!
        </p>
    </div>

    {{-- Progress Bar --}}
    @php
        $total = count($actionPlan);
        $done = collect($actionPlan)->where('done', true)->count();
        $progress = $total > 0 ? round(($done / $total) * 100) : 0;
    @endphp

    <div class="mb-6">
        <div class="flex justify-between text-sm text-gray-600 mb-1">
            <span>Progress: {{ $progress }}%</span>
            <span>{{ $done }} of {{ $total }} steps</span>
        </div>
        <div class="w-full bg-gray-200 h-3 rounded-full overflow-hidden">
            <div class="h-3 bg-blue-500 rounded-full transition-all duration-300" style="width: {{ $progress }}%"></div>
        </div>
    </div>

    {{-- Step List --}}
    <ul class="space-y-5">
        @foreach ($actionPlan as $index => $step)
        <li class="flex gap-4 bg-gray-50 p-4 rounded-xl border border-gray-200 shadow-sm">
            {{-- Checkbox --}}
            <div class="pt-1">
                <input type="checkbox"
                    data-index="{{ $index }}"
                    class="toggle-step h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                    {{ $step['done'] ? 'checked' : '' }}>
            </div>

            {{-- Step Content --}}
            <div class="flex-1">
                <p class="text-base font-medium {{ $step['done'] ? 'line-through text-gray-400' : 'text-gray-800' }}">
                    {{ $step['text'] }}
                </p>

                @if (!empty($step['reason']))
                    <p class="text-xs text-gray-500 mt-1 italic">💡 Why: {{ $step['reason'] }}</p>
                @endif

                <span class="inline-block mt-2 text-xs font-semibold px-2 py-1 rounded-full
                    {{ $step['done'] ? 'text-green-600 bg-green-100' : 'text-blue-600 bg-blue-100' }}">
                    {{ $step['done'] ? '✅ Completed' : '✨ Take Action Now' }}
                </span>
            </div>
        </li>
        @endforeach
    </ul>

    {{-- Completion Message --}}
    @if ($progress === 100)
    <div class="text-center text-green-600 font-semibold text-lg mt-6">
        🎉 You've completed all 3 steps! You're unstoppable!
    </div>
    @endif

    {{-- Footer --}}
    <div class="text-center mt-10 space-y-4">
        <p class="text-sm text-gray-500 italic">
            “Consistency beats intensity. Keep going, and your business will thank you.” 💡
        </p>
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition">
            ← Back
        </a>
    </div>
</div>

{{-- JavaScript --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toggle-step').forEach(input => {
            input.addEventListener('change', function () {
                fetch("{{ route('action.plan.complete') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ index: this.dataset.index })
                }).then(() => {
                    location.reload(); // Refresh the page to update progress UI
                });
            });
        });
    });
</script>
@endsection
