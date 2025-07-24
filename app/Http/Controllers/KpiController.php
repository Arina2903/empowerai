<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kpi;

class KpiController extends Controller
{
    public function index()
    {
        $kpis = Kpi::orderBy('year')->orderBy('month')->get();
        return view('kpis.index', compact('kpis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer',
            'month' => 'required|integer|min:1|max:12',
            'sales' => 'required|numeric',
            'cost' => 'required|numeric',
            'team_size' => 'required|integer',
        ]);

        Kpi::updateOrCreate(
            ['year' => $request->year, 'month' => $request->month],
            $request->only(['sales', 'cost', 'team_size'])
        );

        return redirect()->route('kpis.index')->with('success', 'KPI data saved!');
    }
}
