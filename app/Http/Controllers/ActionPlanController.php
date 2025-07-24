<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ActionPlanController extends Controller
{
    public function show()
    {
        $actionPlan = Session::get('action_plan', [
            ['text' => 'Track your weekly sales', 'done' => false],
            ['text' => 'List your active products', 'done' => false],
            ['text' => 'Set monthly revenue goals', 'done' => false],
        ]);

        return view('action-plan', compact('actionPlan'));
    }

    public function markDone(Request $request)
    {
        $index = $request->input('index');
        $actionPlan = Session::get('action_plan', []);

        if (isset($actionPlan[$index])) {
            $actionPlan[$index]['done'] = !$actionPlan[$index]['done'];
            Session::put('action_plan', $actionPlan);
        }

        return response()->json(['success' => true]);
    }

    public function complete(Request $request)
    {
        $index = $request->input('index');

        // Load current session plan
        $actionPlan = session('actionPlan', []);

        if (isset($actionPlan[$index])) {
            $actionPlan[$index]['done'] = !$actionPlan[$index]['done'];
            session(['actionPlan' => $actionPlan]);
        }

        // Calculate new progress
        $total = count($actionPlan);
        $done = collect($actionPlan)->where('done', true)->count();
        $progress = $total > 0 ? round(($done / $total) * 100) : 0;

        return response()->json([
            'done' => $done,
            'total' => $total,
            'progress' => $progress
        ]);
    }

}
