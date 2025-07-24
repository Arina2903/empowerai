@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6 bg-white rounded-xl shadow-md border border-gray-200">

    {{-- Title --}}
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800">📊 Business KPI Tracker</h2>
        <p class="text-gray-600 mt-2">Track daily effort, monthly performance, and yearly progress of your business.</p>
    </div>

    {{-- Form: Add KPI Data --}}
    <div class="bg-gray-50 p-6 rounded-lg border border-gray-100 mb-8">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">📝 Log Monthly KPI</h3>

        <form method="POST" action="{{ route('kpis.store') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @csrf
            <div>
                <label class="block text-sm text-gray-700 font-medium">📅 Year</label>
                <input type="number" name="year" class="w-full mt-1 px-3 py-2 border rounded focus:ring-blue-200" placeholder="e.g. 2025" required>
            </div>
            @php
                $months = [
                    1 => 'January (1 Jan – 31 Jan)',
                    2 => 'February (1 Feb – 28/29 Feb)',
                    3 => 'March (1 Mar – 31 Mar)',
                    4 => 'April (1 Apr – 30 Apr)',
                    5 => 'May (1 May – 31 May)',
                    6 => 'June (1 Jun – 30 Jun)',
                    7 => 'July (1 Jul – 31 Jul)',
                    8 => 'August (1 Aug – 31 Aug)',
                    9 => 'September (1 Sep – 30 Sep)',
                    10 => 'October (1 Oct – 31 Oct)',
                    11 => 'November (1 Nov – 30 Nov)',
                    12 => 'December (1 Dec – 31 Dec)',
                ];
            @endphp

            <div>
                <label class="block text-sm text-gray-700 font-medium">🗓️ Month</label>
                <select name="month" class="w-full mt-1 px-3 py-2 border rounded focus:ring-blue-200" required>
                    <option value="" disabled selected>Choose month...</option>
                    @foreach ($months as $num => $label)
                        <option value="{{ $num }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm text-gray-700 font-medium">💰 Sales (RM)</label>
                <input type="number" step="0.01" name="sales" class="w-full mt-1 px-3 py-2 border rounded focus:ring-blue-200" required>
            </div>
            <div>
                <label class="block text-sm text-gray-700 font-medium">📉 Cost (RM)</label>
                <input type="number" step="0.01" name="cost" class="w-full mt-1 px-3 py-2 border rounded focus:ring-blue-200" required>
            </div>
            <div>
                <label class="block text-sm text-gray-700 font-medium">👥 Team Size</label>
                <input type="number" name="team_size" class="w-full mt-1 px-3 py-2 border rounded focus:ring-blue-200" required>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                    ➕ Save KPI
                </button>
            </div>
        </form>
    </div>

    {{-- KPI Chart --}}
    <div class="mb-10">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">📈 Monthly KPI Performance</h3>
        <canvas id="kpiChart" height="120"></canvas>
    </div>

    {{-- Footer: Back to Welcome --}}
    <div class="text-center mt-8">
        <a href="{{ url('/') }}"
        class="inline-flex items-center px-4 py-2 text-blue-600 hover:underline text-sm font-medium transition">
            ← Back
        </a>
    </div>

</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = {!! json_encode($kpis->map->month_label) !!};
    const sales = {!! json_encode($kpis->pluck('sales')) !!};
    const cost = {!! json_encode($kpis->pluck('cost')) !!};
    const profit = {!! json_encode($kpis->map(fn($k) => $k->profit)) !!};

    new Chart(document.getElementById('kpiChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Sales (RM)',
                    data: sales,
                    borderColor: 'green',
                    backgroundColor: 'rgba(0,128,0,0.1)',
                    fill: false,
                    tension: 0.3
                },
                {
                    label: 'Cost (RM)',
                    data: cost,
                    borderColor: 'red',
                    backgroundColor: 'rgba(255,0,0,0.1)',
                    fill: false,
                    tension: 0.3
                },
                {
                    label: 'Profit (RM)',
                    data: profit,
                    borderColor: 'blue',
                    backgroundColor: 'rgba(0,0,255,0.1)',
                    fill: false,
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'RM ' + context.formattedValue;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => 'RM ' + value
                    }
                }
            }
        }
    });
</script>
@endsection
