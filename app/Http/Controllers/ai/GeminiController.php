<?php

namespace App\Http\Controllers\ai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gemini\Laravel\Facades\Gemini;
use App\Models\ChatAI;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\HitungBiayaVariabel;
use App\Models\HitungBiayaTetap;
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
        $request->validate([
            'chat' => 'required|string|max:255',
            'user_id' => 'required|integer|exists:users,id',
        ]);
    
        $result = Gemini::geminiPro()->generateContent($request->chat);
        $parsedown = new Parsedown();
        $parsedAnswer = $parsedown->text($result->text());
    
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

    public function analisisManajemen(Request $request)
    {
        $user_id = Auth::id();

        // Mengambil data yang diperlukan
        $variabel = HitungBiayaVariabel::latest()->get();
        $tetap = HitungBiayaTetap::latest()->get();
        $totalBiayaVariabel = DB::table('hitung_biaya_variabel')
            ->where('user_id', $user_id)
            ->sum('total_biaya');
        $totalBiayaTetap = DB::table('hitung_biaya_tetap')
            ->where('user_id', $user_id)
            ->sum('total_biaya');

        $AmbilHargaJual = DB::table('hitung_harga_jual')
            ->where('user_id', $user_id)
            ->latest('updated_at')
            ->first();
        $hargaJual = $AmbilHargaJual ? $AmbilHargaJual->harga_jual : null;

        $AmbilHPP = DB::table('hitung_hpp')
            ->where('user_id', $user_id)
            ->latest('updated_at')
            ->first();
        $hpp = $AmbilHPP ? $AmbilHPP->hpp : null;

        $AmbilBEPUnit = DB::table('hitung_bep')
            ->where('user_id', $user_id)
            ->latest('updated_at')
            ->first();
        $bepUnit = $AmbilBEPUnit ? $AmbilBEPUnit->bep : null;

        $AmbilBEPRupiah = DB::table('hitung_bep_rupiah')
            ->where('user_id', $user_id)
            ->latest('updated_at')
            ->first();
        $bepRupiah = $AmbilBEPRupiah ? $AmbilBEPRupiah->bep_rupiah : null;

        $AmbilPerkiraanPenjulan = DB::table('hitung_perkiraan_penjualan')
            ->where('user_id', $user_id)
            ->latest('updated_at')
            ->first();
        $perkiraanPenjualan = $AmbilPerkiraanPenjulan ? $AmbilPerkiraanPenjulan->perkiraan_penjualan : null;

        $AmbilBiayaProduksi = DB::table('hitung_biaya_produksi')
            ->where('user_id', $user_id)
            ->latest('updated_at')
            ->first();
        $biayaProduksi = $AmbilBiayaProduksi ? $AmbilBiayaProduksi->biaya_produksi : null;

        $AmbilLabaUsaha = DB::table('hitung_laba_usaha')
            ->where('user_id', $user_id)
            ->latest('updated_at')
            ->first();
        $labaUsaha = $AmbilLabaUsaha ? $AmbilLabaUsaha->laba_usaha : null;

        $AmbilLabaKotor = DB::table('hitung_laba_kotor')
            ->where('user_id', $user_id)
            ->latest('updated_at')
            ->first();
        $labaKotor = $AmbilLabaKotor ? $AmbilLabaKotor->laba_kotor : null;

        $AmbilBCRatio = DB::table('hitung_bc_ratio')
            ->where('user_id', $user_id)
            ->latest('updated_at')
            ->first();
        $BCRatio = $AmbilBCRatio ? $AmbilBCRatio->bc_ratio : null;

        $AmbilGrosProfitMargin = DB::table('hitung_gros_profit_margin')
            ->where('user_id', $user_id)
            ->latest('updated_at')
            ->first();
        $grosProfitMargin = $AmbilGrosProfitMargin ? $AmbilGrosProfitMargin->gros_profit_margin : null;

        $AmbilNetProfitMargin = DB::table('hitung_net_profit_margin')
            ->where('user_id', $user_id)
            ->latest('updated_at')
            ->first();
        $netProfitMargin = $AmbilNetProfitMargin ? $AmbilNetProfitMargin->net_profit_margin : null;

        $analysisInput = "Analisis berikut dan apakah ada yang perlu diperhatikan berdasarkan data keuangan: Biaya Variabel: $totalBiayaVariabel, Biaya Tetap: $totalBiayaTetap, Harga Jual: $hargaJual, HPP: $hpp, BEP Unit: $bepUnit, Perkiraan Penjualan: $perkiraanPenjualan.";

        $aiInput = $analysisInput;

        $result = Gemini::geminiPro()->generateContent($aiInput);
        $parsedown = new Parsedown();
        $parsedAnswer = $parsedown->text($result->text());

        $chat = new ChatAI();
        $chat->user_id = $user_id;
        $chat->chat = 'Analisis Manajemen Keuangan';
        $chat->answer = $parsedAnswer;
        $chat->save();

        return view('seller.chat', [
            'chat' => $chat,
            'message' => $result->text()
        ]);
    }

    
}
