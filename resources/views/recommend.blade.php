@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-2xl shadow-md border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">📘 Skill & Knowledge Recommendations</h2>

        @if(isset($recommendations))
            <p class="mb-3 text-gray-700">
                Based on your business audit, here's an area where you can improve:
            </p>

            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4 rounded">
                <strong>🧠 Focus Area:</strong> {{ $recommendations['topic'] }}
            </div>

            <p class="text-gray-700 mb-2">We found some useful free resources for you to learn and grow in this area:</p>

            <ul class="list-disc pl-6 text-gray-800">
                @foreach($recommendations['resources'] as $item)
                    <li class="mb-2">
                        <a href="{{ $item['url'] }}" target="_blank" class="text-blue-600 hover:underline">
                            📎 {{ $item['title'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">No recommendations yet. Complete your audit to get personalized learning suggestions.</p>
        @endif

        {{-- Back to Dashboard --}}
        <div class="text-center mt-8">
            <a href="{{ url('/') }}"
               class="inline-flex items-center px-4 py-2 text-blue-600 hover:underline text-sm font-medium transition">
                ← Back
            </a>
        </div>
    </div>
@endsection
