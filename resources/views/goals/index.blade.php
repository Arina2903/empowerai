@extends('layouts.app') {{-- or layouts.main --}}

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-md border border-gray-200">

    {{-- Page Title --}}
    <div class="text-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">🎯 Goal & Progress Tracker</h2>
        <p class="text-gray-500 mt-1">Plan, track, and achieve your personal or business goals.</p>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Goal Form --}}
    <form action="{{ route('goals.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">🎯 Goal Title</label>
            <input type="text" name="title" class="w-full mt-1 px-4 py-2 border rounded focus:ring focus:ring-blue-200" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">📝 Description</label>
            <textarea name="description" class="w-full mt-1 px-4 py-2 border rounded focus:ring focus:ring-blue-200"></textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">📅 Deadline</label>
            <input type="date" name="deadline" class="w-full mt-1 px-4 py-2 border rounded focus:ring focus:ring-blue-200" required>
        </div>
        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">➕ Add Goal</button>
    </form>

    {{-- You can re-enable this later to show goals --}}
    {{--
    <div class="mt-10">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">📋 Your Goals</h3>

        @forelse($goals as $goal)
            <div class="mb-4 p-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800">{{ $goal->title }}</h4>
                        <p class="text-sm text-gray-600">{{ $goal->description }}</p>
                        <p class="text-xs text-gray-500 mt-1">Deadline: {{ \Carbon\Carbon::parse($goal->deadline)->format('d M Y') }}</p>
                    </div>
                    <div class="text-sm font-bold {{ $goal->completed ? 'text-green-600' : 'text-yellow-600' }}">
                        {{ $goal->completed ? '✅ Completed' : '⏳ In Progress' }}
                    </div>
                </div>

                <div class="mt-3 w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                    <div class="h-3 bg-blue-500 rounded-full transition-all duration-300" style="width: {{ $goal->completed ? '100' : '0' }}%"></div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">You haven’t set any goals yet. Let’s get started above!</p>
        @endforelse
    </div>
    --}}

    {{-- Footer Back Link --}}
    <div class="text-center mt-8">
        <a href="{{ url('/') }}"
           class="inline-flex items-center px-4 py-2 text-blue-600 hover:underline text-sm font-medium transition">
            ← Back
        </a>
    </div>
</div>
@endsection
