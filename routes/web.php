<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AIChatController;
use App\Http\Controllers\HealthCheckController;
use App\Http\Controllers\ActionPlanController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\KpiController;
use App\Http\Controllers\SkillRecommenderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [LandingController::class, 'welcome']);

Route::get('/chatbot', [AIChatController::class, 'index'])->name('chatbot');
Route::post('/ask', [AIChatController::class, 'ask'])->name('chatbot.ask');

Route::get('/health-check', [HealthCheckController::class, 'showForm'])->name('health.check');
Route::post('/health-check', [HealthCheckController::class, 'submit'])->name('health.submit');

Route::get('/action-plan', [ActionPlanController::class, 'show'])->name('action.plan');
Route::post('/action-plan/complete', [ActionPlanController::class, 'markDone'])->name('action.plan.complete');

Route::get('/goals', [\App\Http\Controllers\GoalController::class, 'index'])->name('goals.index');
Route::post('/goals', [\App\Http\Controllers\GoalController::class, 'store'])->name('goals.store');

Route::get('/kpis', [KpiController::class, 'index'])->name('kpis.index');
Route::post('/kpis', [KpiController::class, 'store'])->name('kpis.store');

Route::get('/recommend-skills', function () {
    return view('recommend'); // or the appropriate blade view
})->name('recommend.skills');
