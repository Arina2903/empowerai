@extends('layouts.app')

@section('content')
<style>
    .chat-window {
        max-width: 600px;
        margin: 40px auto;
        background: #fff8e1;
        border: 1px solid #f8b500;
        border-radius: 10px;
        padding: 20px;
    }
    .message {
        margin-bottom: 10px;
        text-align: left;
    }
    .message.user {
        text-align: right;
        color: #333;
    }
    .message.ai {
        color: #444;
        background: #fff3cd;
        border-radius: 8px;
        padding: 10px;
    }
</style>

<div class="chat-window">
    <h2 style="text-align: center; color: #f8b500;">Chatbot Konsultasi AI</h2>
    <p style="text-align: center;">Tanya sebarang soalan berkaitan perniagaan anda.</p>

    <div id="chat-log" style="margin-top: 20px; min-height: 200px;"></div>

    <div style="margin-top: 20px; display: flex;">
        <input id="user-input" type="text" placeholder="Contoh: Bagaimana nak mula bisnes makanan?"
               style="flex: 1; padding: 10px 15px; border: 1px solid #ccc; border-radius: 8px;" />

        <button onclick="sendQuestion()"
                style="padding: 10px 20px; background-color: #f8b500; color: white; border: none; border-radius: 8px; margin-left: 10px; cursor: pointer;">
            Hantar
        </button>
    </div>

    <div style="margin-top: 30px; text-align: center;">
        <a href="{{ url('/') }}" style="padding: 10px 20px; background-color: #ccc; color: #333; border-radius: 8px; text-decoration: none;">
            ← Kembali ke Laman Utama
        </a>
    </div>
</div>

<script>
    async function sendQuestion() {
        const input = document.getElementById('user-input');
        const question = input.value.trim();
        if (!question) return;

        // Display user question
        const chatLog = document.getElementById('chat-log');
        chatLog.innerHTML += `<div class="message user"><strong>Anda:</strong> ${question}</div>`;
        input.value = '';

        // Send to backend
        try {
            const response = await fetch("{{ route('chatbot.ask') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ question })
            });

            const data = await response.json();

            // Display AI response
            chatLog.innerHTML += `<div class="message ai"><strong>AI:</strong> ${data.answer}</div>`;
            chatLog.scrollTop = chatLog.scrollHeight;
        } catch (err) {
            chatLog.innerHTML += `<div class="message ai"><strong>AI:</strong> Maaf, berlaku ralat.</div>`;
        }
    }
</script>
@endsection
