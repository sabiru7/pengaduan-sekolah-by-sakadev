<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Pengaduan;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        try {
            $message = strtolower(trim($request->input('message')));

            if (!$message) {
                return response()->json([
                    'response' => 'Pesan kamu kosong 😅 coba tulis sesuatu ya'
                ], 400);
            }

            $apiKey = env('GEMINI_API_KEY');

            /*
            |--------------------------------------------------------------------------
            | 🔥 FALLBACK RESPONSES
            |--------------------------------------------------------------------------
            */
            $responses = [
                'greeting' => ['Halo 👋 Ada yang bisa saya bantu?', 'Hai 😊 lagi butuh bantuan apa?'],
                'login' => ['Untuk login, klik tombol "Login" ya 👍'],
                'register' => ['Belum punya akun? daftar dulu ya ✍️'],
                'logout' => ['Untuk logout, klik tombol "Logout" ya 👍'],
                'pengaduan' => ['Klik "Buat Pengaduan" ya 📄', 'Langsung klik "Buat Pengaduan" 😊'],
                'cara' => ['Cara: login → buat pengaduan → kirim 🚀'],
                'proses' => ['Alur: kirim → diproses → selesai ✅'],
                'guest' => ['Login dulu ya buat cek status 😊'],
                'empty' => ['Kamu belum punya pengaduan 😅'],
                'thanks' => ['Sama-sama 😊'],
                'default' => ['Coba tanya soal pengaduan atau akun ya 😅']
            ];

            /*
            |--------------------------------------------------------------------------
            | 🔥 FALLBACK FUNCTION
            |--------------------------------------------------------------------------
            */
            $fallback = function ($msg) use ($responses) {

                if (str_contains($msg, 'halo') || str_contains($msg, 'hai')) return $responses['greeting'][array_rand($responses['greeting'])];
                if (str_contains($msg, 'login')) return $responses['login'][array_rand($responses['login'])];
                if (str_contains($msg, 'daftar')) return $responses['register'][array_rand($responses['register'])];
                if (str_contains($msg, 'logout')) return $responses['logout'][array_rand($responses['logout'])];
                if (str_contains($msg, 'cara')) return $responses['cara'][array_rand($responses['cara'])];
                if (str_contains($msg, 'lapor') || str_contains($msg, 'pengaduan')) return $responses['pengaduan'][array_rand($responses['pengaduan'])];
                if (str_contains($msg, 'proses')) return $responses['proses'][array_rand($responses['proses'])];
                if (str_contains($msg, 'terima kasih')) return $responses['thanks'][array_rand($responses['thanks'])];

                if (str_contains($msg, 'status') || str_contains($msg, 'cek')) {

                    if (!Auth::check()) return $responses['guest'][0];

                    try {
                        $p = Pengaduan::where('user_id', Auth::id())->latest()->first();

                        if (!$p) return $responses['empty'][0];

                        return "📄 {$p->judul}\nStatus: {$p->status}";
                    } catch (\Exception $e) {
                        Log::error($e);
                        return 'Gagal ambil data 😅';
                    }
                }

                return $responses['default'][array_rand($responses['default'])];
            };

            /*
            |--------------------------------------------------------------------------
            | 🔥 INTENT
            |--------------------------------------------------------------------------
            */
            $intent = 'general';

            if (str_contains($message, 'login')) $intent = 'login';
            elseif (str_contains($message, 'daftar')) $intent = 'register';
            elseif (str_contains($message, 'logout')) $intent = 'logout';
            elseif (str_contains($message, 'lapor')) $intent = 'pengaduan';
            elseif (str_contains($message, 'status')) $intent = 'status';
            elseif (str_contains($message, 'cara')) $intent = 'cara';

            /*
            |--------------------------------------------------------------------------
            | 🔥 CONTEXT DB (SAFE)
            |--------------------------------------------------------------------------
            */
            $userContext = "User belum login";

            if (Auth::check()) {
                try {
                    $pengaduans = Pengaduan::where('user_id', Auth::id())
                        ->latest()
                        ->take(3)
                        ->get();

                    if ($pengaduans->isEmpty()) {
                        $userContext = "User login tapi belum ada pengaduan";
                    } else {
                        $list = "";
                        foreach ($pengaduans as $p) {
                            $list .= "- {$p->judul} ({$p->status})\n";
                        }
                        $userContext = $list;
                    }
                } catch (\Exception $e) {
                    Log::error($e);
                    $userContext = "Gagal ambil data";
                }
            }

            /*
            |--------------------------------------------------------------------------
            | ❌ NO API
            |--------------------------------------------------------------------------
            */
            if (!$apiKey) {
                return response()->json([
                    'response' => $fallback($message)
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | 🔥 GEMINI CALL (SAFE)
            |--------------------------------------------------------------------------
            */
            try {

                $response = Http::timeout(30)
                    ->retry(2, 1000)
                    ->post(
                        "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $apiKey,
                        [
                            "contents" => [
                                [
                                    "parts" => [
                                        [
                                            "text" => "Chatbot pengaduan sekolah.

User: " . (Auth::check() ? 'login' : 'guest') . "
Intent: $intent
Data:
$userContext

Jawab singkat, santai, max 2 kalimat, pakai emoji 😊
Kalau belum login suruh login
Jangan ngarang data

Pesan: $message"
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    );

                if (!$response->successful()) {
                    Log::error('Gemini error: ' . $response->body());
                    return response()->json([
                        'response' => $fallback($message)
                    ]);
                }

                $data = $response->json();

                $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

                if (!$reply) {
                    Log::warning('Gemini kosong', $data);
                    $reply = $fallback($message);
                }

                return response()->json([
                    'response' => $reply
                ]);

            } catch (\Exception $e) {

                Log::error($e);

                return response()->json([
                    'response' => $fallback($message)
                ]);
            }

        } catch (\Exception $e) {

            Log::critical($e);

            return response()->json([
                'response' => '⚠️ Sistem error 😅 cek log ya'
            ]);
        }
    }
}