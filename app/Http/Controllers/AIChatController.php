<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;

class AIChatController extends Controller
{
    public function index()
    {
        session()->put('chat_history', []); // Reset chat history on reload
        return view('chatbot');
    }

    public function ask(Request $request)
    {
        $question = $request->input('question') ?? $request->input('message');

        try {
            // ✅ Basic single-message test mode (used for quick requests)
            if ($request->has('message')) {
                $result = OpenAI::chat()->create([
                    'model' => 'gpt-3.5-turbo', // Use GPT-3.5 for quick replies
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a helpful AI assistant speaking in Malay.'],
                        ['role' => 'user', 'content' => $question],
                    ],
                ]);

                $answer = $result->choices[0]->message->content ?? 'Tiada jawapan.';
                $answer = nl2br($answer);
                
                return response()->json(['answer' => $answer]);
            }

            // ✅ Full history mode
            $history = session('chat_history', []);
            $messages = [
                ['role' => 'system', 'content' => 'Anda adalah jurulatih bisnes dari RichWorks. Jawab dalam bahasa Melayu yang ringkas dan praktikal.']
            ];

            foreach ($history as $msg) {
                $messages[] = ['role' => 'user', 'content' => $msg['question']];
                $messages[] = ['role' => 'assistant', 'content' => $msg['answer']];
            }

            $messages[] = ['role' => 'user', 'content' => $question];

            $response = OpenAI::chat()->create([
                'model' => 'gpt-4o',
                'messages' => $messages,
            ]);

            $answer = $response->choices[0]->message->content ?? 'Tiada jawapan.';
            $history[] = ['question' => $question, 'answer' => $answer];
            session()->put('chat_history', $history);

            return response()->json(['answer' => $answer]);

        } catch (\Exception $e) {
            Log::error('OpenAI Error: ' . $e->getMessage());
            return response()->json(['answer' => 'Maaf, berlaku ralat: ' . $e->getMessage()], 500);
        }
    }

}
