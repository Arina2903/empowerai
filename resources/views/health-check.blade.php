@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12 px-4 max-w-3xl">

    {{-- Title --}}
    <div class="text-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">🩺 Business Health Check</h2>
        <p class="text-gray-600 text-lg">Answer these 8 quick questions to assess your business health.</p>
    </div>

    {{-- Back Button --}}
    <div class="mb-8">
        <a href="{{ url()->previous() }}"
           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition duration-200"
        >
            ← Back
        </a>
    </div>

    {{-- Result Box --}}
    @if(session('done'))
        @php
            $result = session('audit_result');
            $bgColor = match($result['color']) {
                'green' => 'bg-green-100 border-green-600 text-green-800',
                'yellow' => 'bg-yellow-100 border-yellow-600 text-yellow-800',
                'red' => 'bg-red-100 border-red-600 text-red-800',
                default => 'bg-gray-100 border-gray-600 text-gray-800'
            };
        @endphp
        <div class="p-6 mb-8 rounded-xl shadow-md border-l-4 transition-all duration-300 {{ $bgColor }}">
            <h3 class="text-xl font-semibold">
                {{ $result['emoji'] }} Your Score: {{ $result['score'] }}%
            </h3>
            <p class="mt-1 font-medium">
                Status: <strong>{{ $result['status'] }}</strong>
            </p>
        </div>
    @endif

    {{-- Business Health Form --}}
    <form method="POST" action="{{ route('health.submit') }}" class="space-y-6">
        @csrf

        @php
            $questions = [
                'How clear is your business vision and direction?',
                'Do you have a well-defined target market?',
                'Is your current marketing strategy effective?',
                'How consistent are your monthly sales or revenue?',
                'Do you have proper financial tracking and budgeting in place?',
                'How strong and productive is your current team?',
                'Do you have a scalable and repeatable business model?',
                'Are you actively improving your skills as a business owner?',
            ];

            $scaleOptions = [
                1 => ['label' => '1 - Poor',        'color' => '#F87171'],
                2 => ['label' => '2 - Fair',        'color' => '#FB923C'],
                3 => ['label' => '3 - Good',        'color' => '#FACC15'],
                4 => ['label' => '4 - Very Good',   'color' => '#4ADE80'],
                5 => ['label' => '5 - Excellent',   'color' => '#22D3EE'],
            ];
        @endphp

        @foreach($questions as $index => $question)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 p-5">
                <label class="block text-gray-800 font-semibold mb-2">
                    Q{{ $index + 1 }}. {{ $question }}
                </label>
                <select
                    name="q{{ $index + 1 }}"
                    required
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
                >
                    <option value="">Select a score</option>
                    @foreach($scaleOptions as $value => $option)
                        <option
                            value="{{ $value }}"
                            style="color: {{ $option['color'] }}"
                            {{ old('q' . ($index + 1)) == $value ? 'selected' : '' }}
                        >
                            {{ $option['label'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endforeach

        {{-- Submit Button --}}
        <div class="text-center mt-8">
            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full shadow-md transition duration-300"
            >
                ✅ Submit My Health Check
            </button>
        </div>
    </form>
</div>
@endsection
