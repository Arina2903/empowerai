<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HealthCheckController extends Controller
{
    public function showForm()
    {
        return view('health-check');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'q1' => 'required|integer|min:1|max:5',
            'q2' => 'required|integer|min:1|max:5',
            'q3' => 'required|integer|min:1|max:5',
            'q4' => 'required|integer|min:1|max:5',
            'q5' => 'required|integer|min:1|max:5',
            'q6' => 'required|integer|min:1|max:5',
            'q7' => 'required|integer|min:1|max:5',
            'q8' => 'required|integer|min:1|max:5',
        ]);

        $score = array_sum($validated) * 2.5; // 8 questions x 5 max = 40 x 2.5 = 100%

        $result = [
            'score' => $score,
            'emoji' => $score >= 80 ? '🟢' : ($score >= 50 ? '🟡' : '🔴'),
            'status' => $score >= 80 ? 'Sihat' : ($score >= 50 ? 'Berisiko' : 'Bahaya'),
            'color' => $score >= 80 ? 'green' : ($score >= 50 ? 'yellow' : 'red'),
        ];

        return redirect()->route('health.check')->with([
            'done' => true,
            'audit_result' => $result
        ]);
    }
}
