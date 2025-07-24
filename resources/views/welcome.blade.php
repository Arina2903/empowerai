@extends('layouts.app')

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap');

    body {
        font-family: 'Space Grotesk', sans-serif;
        background: #fffde6;
        color: #1f2937;
        margin: 0;
    }

    .welcome-container {
        background: linear-gradient(145deg, #fefce8, #fffde7);
        position: relative;
        overflow: hidden;
        padding: 60px 40px;
        border-radius: 24px;
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.1);
        max-width: 900px;
        margin: 80px auto;
        text-align: center;
    }

    .welcome-container::before,
    .welcome-container::after {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(254, 240, 138, 0.4);
        z-index: 0;
    }

    .welcome-container::before {
        top: -100px;
        left: -80px;
        filter: blur(80px);
    }

    .welcome-container::after {
        bottom: -100px;
        right: -60px;
        filter: blur(80px);
    }

    .tagline {
        font-size: 2.8rem;
        font-weight: 700;
        background: linear-gradient(to right, #facc15, #f59e0b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin: 0.5rem 0;
        opacity: 0;
        transform: translateY(-20px);
        animation: fadeInDown 1s ease-in-out forwards;
    }

    .description {
        font-size: 1.25rem;
        margin: 30px 0 50px;
        color: #4b5563;
        line-height: 1.6;
        opacity: 0;
        animation: fadeInUp 1s ease-in-out 0.5s forwards;
    }

    .features {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 24px;
        margin-bottom: 40px;
    }

    .feature-box {
        flex: 1 1 220px;
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        z-index: 1;
        position: relative;
    }

    .feature-box:hover {
        box-shadow: 0 0 20px #facc15;
        transform: translateY(-5px);
    }

    .chat-button {
        display: inline-block;
        padding: 16px 36px;
        font-size: 1.1rem;
        background-color: #facc15;
        color: #1f2937;
        font-weight: 600;
        border: none;
        border-radius: 14px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        animation: pulse 2s infinite;
        text-decoration: none;
    }

    .chat-button:hover {
        background-color: #eab308;
        transform: scale(1.05);
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(250, 204, 21, 0.7); }
        70% { box-shadow: 0 0 0 20px rgba(250, 204, 21, 0); }
        100% { box-shadow: 0 0 0 0 rgba(250, 204, 21, 0); }
    }

    @keyframes fadeInDown {
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .tagline {
            font-size: 1.8rem;
        }

        .description {
            font-size: 1.1rem;
        }

        .features {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')
<div class="welcome-container" style="text-align: center; padding: 40px 20px;">

    <h1 class="tagline" style="font-size: 2.5em; font-weight: bold; margin-bottom: 10px;">We Grow</h1>
    <h1 class="tagline" style="font-size: 2.5em; font-weight: bold; margin-bottom: 10px;">We Build</h1>
    <h1 class="tagline" style="font-size: 2.5em; font-weight: bold; color: #0077cc;">Our Future Starts Today</h1>

    <p class="description" style="font-size: 1.2em; margin-top: 20px; color: #444;">
        <strong>Ready to transform your business with the power of AI?</strong><br>
        Explore tools designed to help entrepreneurs grow smarter and faster.
    </p>

    {{-- Feature Pills --}}
    <div class="features" style="margin-top: 40px; display: flex; flex-direction: column; gap: 25px; align-items: center;">

        {{-- Box 1 --}}
        <a href="{{ route('health.check') }}" style="
            background: linear-gradient(to right, #e0f7fa, #ffffff);
            border-radius: 50px;
            padding: 25px 30px;
            width: 90%;
            max-width: 700px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            color: #004d40;
            font-size: 1.1em;
            transition: 0.3s ease;
            display: flex;
            align-items: center;
        " onmouseover="this.style.background='#ccf2f4';">
            <strong style="margin-left: 15px;">Business Health Check (Quick Audit)</strong><br>
            <span style="margin-left: 15px;">Know your real business condition in <strong>2 minutes</strong>. Take the quick check now!</span>
        </a>

        {{-- Box 2 --}}
        <a href="{{ route('action.plan') }}" style="
            background: linear-gradient(to right, #fff0f5, #ffffff);
            border-radius: 50px;
            padding: 25px 30px;
            width: 90%;
            max-width: 700px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            color: #880e4f;
            font-size: 1.1em;
            transition: 0.3s ease;
            display: flex;
            align-items: center;
        " onmouseover="this.style.background='#ffe6f0';">
            <strong style="margin-left: 15px;">Personalized Action Plan</strong><br>
            <span style="margin-left: 15px;">Get <strong>3 clear steps</strong> to move forward. Turn advice into real action!</span>
        </a>

        {{-- Box 3 --}}
        <a href="{{ route('goals.index') }}" style="
            background: linear-gradient(to right, #e8f5e9, #ffffff);
            border-radius: 50px;
            padding: 25px 30px;
            width: 90%;
            max-width: 700px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            color: #1b5e20;
            font-size: 1.1em;
            transition: 0.3s ease;
            display: flex;
            align-items: center;
        " onmouseover="this.style.background='#d0f0d5';">
            <strong style="margin-left: 15px;">Goal & Progress Tracker</strong><br>
            <span style="margin-left: 15px;">Stay focused and track your <strong>wins</strong>. Start setting your goals!</span>
        </a>

        {{-- Box 4 --}}
        <div style="
            background: linear-gradient(to right, #fffde7, #ffffff);
            border-radius: 50px;
            padding: 25px 30px;
            width: 90%;
            max-width: 700px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            color: #795548;
            font-size: 1.1em;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        ">
            <strong style="margin-left: 0;">Revenue & KPI Tracker</strong><br>
            <span style="margin-left: 0;">Track your <strong>sales, team growth, and costs</strong> easily. See your progress in charts!</span>
            <a href="{{ route('kpis.index') }}" class="btn btn-primary mt-2" style="
                background: #795548;
                color: white;
                padding: 10px 20px;
                border-radius: 30px;
                margin-top: 10px;
                text-decoration: none;
            ">Track Now</a>
        </div>

        {{-- Box 5 --}}
        <a href="{{ route('recommend.skills') }}" style="
            background: linear-gradient(to right, #ede7f6, #ffffff);
            border-radius: 50px;
            padding: 25px 30px;
            width: 90%;
            max-width: 700px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            color: #4527a0;
            font-size: 1.1em;
            transition: 0.3s ease;
            display: flex;
            align-items: center;
        " onmouseover="this.style.background='#d8cff2';">
            🩺 <strong style="margin-left: 15px;">Skill & Knowledge Recommender</strong><br>
            <span style="margin-left: 15px;">Learn what your business really needs. Find quick videos and tips!</span>
        </a>

    </div>

    {{-- Floating Chatbot --}}
    <a href="{{ url('/chatbot') }}" title="Chatbot AI" style="
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: #0077cc;
        color: white;
        font-size: 24px;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        z-index: 999;
    ">
        💬
    </a>

</div>
@endsection
