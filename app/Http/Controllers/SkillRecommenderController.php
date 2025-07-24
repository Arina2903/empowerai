<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class SkillRecommenderController extends Controller
{
    public function recommend(Request $request)
    {
        $gap = $request->input('user_gap');

        // 🧠 Use OpenAI to get learning recommendation
        $response = OpenAI::chat()->create([
            'model' => 'gpt-4o',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a business skill coach. Based on user gaps, suggest ONE main topic and 3 helpful video/article titles with links. Reply in JSON like: {"topic": "Topic Name", "resources": [{"title": "...", "url": "..."}, ...]}'],
                ['role' => 'user', 'content' => "I need help with this: $gap"],
            ],
        ]);

        $aiReply = $response->choices[0]->message->content;

        // 🛠 Try to parse AI JSON response
        $recommendations = json_decode($aiReply, true);

        // 💥 Fallback if parsing fails (for safety)
        if (!$recommendations || !isset($recommendations['resources'])) {
            $recommendations = [
                'topic' => 'Marketing Strategy',
                'resources' => [
                    ['title' => 'How to Build a Marketing Plan', 'url' => 'https://www.youtube.com/watch?v=abc123'],
                    ['title' => 'Top 5 Marketing Tools for Small Business', 'url' => 'https://www.youtube.com/watch?v=xyz456'],
                    ['title' => 'How to Understand Your Customers Better', 'url' => 'https://medium.com/smallbiz/customer-insight-guide'],
                ]
            ];
        }

        return view('dashboard', compact('recommendations'));
    }
}
