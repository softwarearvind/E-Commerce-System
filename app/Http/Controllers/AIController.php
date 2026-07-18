<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    public function generateDescription(Request $request)
    {
        dd($request->all());
        $request->validate([
            'name' => 'required|string'
        ]);

        $response = Http::withToken(env('OPENAI_API_KEY'))
            ->post('https://api.openai.com/v1/chat/completions', [

                'model' => 'gpt-4.1-mini',

                'messages' => [

                    [
                        'role' => 'system',
                        'content' => 'You are an expert ecommerce product copywriter.'
                    ],

                    [
                        'role' => 'user',
                        'content' => 'Write a professional ecommerce product description for: '.$request->name
                    ]

                ],

                'max_tokens' => 250,

            ]);

        if ($response->failed()) {

            return response()->json([
                'description' => 'Unable to generate description.'
            ],500);

        }

        return response()->json([

            'description' => $response['choices'][0]['message']['content']

        ]);
    }
}
