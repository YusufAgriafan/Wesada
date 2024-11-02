<?php

namespace App\Http\Controllers\ai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gemini\Laravel\Facades\Gemini;
use App\Models\ChatAI;
use Parsedown;


class GeminiController extends Controller
{
    public function generateContent2(Request $request)
    {
        $result = Gemini::geminiPro()->generateContent('57 dibagi 3');

        return response()->json([
            'message' => $result->text(),
        ]);
    }

    public function generateContent(Request $request)
    {
        // Validasi input
        $request->validate([
            'chat' => 'required|string|max:255',
            'user_id' => 'required|integer|exists:users,id',
        ]);
    
        // Menghasilkan konten
        $result = Gemini::geminiPro()->generateContent($request->chat);
        $parsedown = new Parsedown();
        $parsedAnswer = $parsedown->text($result->text());
    
        // Simpan ke database
        $chat = new ChatAI();
        $chat->user_id = $request->user_id;
        $chat->chat = $request->chat;
        $chat->answer = $parsedAnswer;
        $chat->save();
    
        return view('seller.chat', [
            'chat' => $chat,
            'message' => $result->text()
        ]);
    }
    
}
