<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        try {
            $message = $request->input('message');

            if (!$message) {
                return response()->json([
                    'response' => 'Pesan kosong'
                ], 400);
            }

            // 🔥 Call ke AI (contoh pakai OpenAI API)
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'system', 'content' => 'Kamu adalah asisten yang membantu user.'],
                    ['role' => 'user', 'content' => $message],
                ],
            ]);

            if ($response->failed()) {
                return response()->json([
                    'response' => 'AI error: ' . $response->body()
                ], 500);
            }

            $result = $response->json();

            $reply = $result['choices'][0]['message']['content'] ?? 'Tidak ada respon';

            return response()->json([
                'response' => $reply
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'response' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }
}