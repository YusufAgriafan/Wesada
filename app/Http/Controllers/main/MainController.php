<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Models\Contact;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function getUnsplashImageUrl($query)
    {
        $accessKey = env('UNSPLASH_ACCESS_KEY');
        
        try {
            $response = Http::retry(3, 1000)
                            ->timeout(20)
                            ->get("https://api.unsplash.com/photos/random", [
                                'query' => $query,
                                'client_id' => $accessKey,
                                'orientation' => 'landscape'
                            ]);
            
            if ($response->successful() && isset($response->json()['urls']['regular'])) {
                return $response->json()['urls']['regular'];
            }
        } catch (\Exception $e) {
            \Log::error("Error fetching image from Unsplash: " . $e->getMessage());
        }
    
        return asset('main/img/blog-1.png');
    }

    public function informasi()
    {
        $informasi = Information::latest()->get()->map(function ($item) {
            $query = 'business ' . rand(1, 100); // Tambahkan variasi random
            $item->imageUrl = $this->getUnsplashImageUrl($query);
            return $item;
        });

        return view('main.informasi', compact('informasi'));
    }

    public function baca(Request $request, $title)
    {
        $informasi = Information::where('title', $title)->first();

        return view('main.baca', compact('informasi'));
    }
    public function contact()
    {
        return view('main.contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'subjek' => 'required',
            'pesan' => 'required',
            'nomor' => 'nullable',
        ]);

        $input = $request->all();

        Contact::create($input);

        return redirect()->route('contact.view')->with('success', 'Pesan Berhasil Dikirim!');
    }

    public function permainan()
    {
        return view('main.permainan');
    }

}
