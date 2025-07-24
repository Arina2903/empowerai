<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuditController extends Controller
{
    public function showForm()
    {
        return view('health-check');
    }

    public function submitForm(Request $request)
    {
        $data = $request->except('_token');

        $score = 0;
        $total = count($data) * 5;

        foreach ($data as $value) {
            $score += (int) $value;
        }

        $percent = ($score / $total) * 100;

        $status = 'Weak';
        $emoji = '📉';
        $color = 'red';

        if ($percent >= 70) {
            $status = 'Strong';
            $emoji = '🚀';
            $color = 'green';
        } elseif ($percent >= 50) {
            $status = 'Average';
            $emoji = '⚠️';
            $color = 'orange';
        }

        Session::put('audit_result', [
            'score' => round($percent),
            'status' => $status,
            'emoji' => $emoji,
            'color' => $color
        ]);

        return redirect()->route('health.check')->with('done', true);
    }
}

