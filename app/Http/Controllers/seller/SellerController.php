<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomNamaUsaha;
use App\Models\CustomNavLink;

class SellerController extends Controller
{
    public function index()
    {
        return view('seller.index');
    }

    public function chat()
    {
        return view('seller.chat');
    }

    public function custom()
    {
        $userId = Auth::id();
        $existingUsaha = CustomNamaUsaha::where('user_id', $userId)->first();
        
        // Inisialisasi $links sebagai koleksi kosong jika $existingUsaha tidak ada
        $links = collect();
        
        if ($existingUsaha) {
            $links = CustomNavLink::where('usaha_id', $existingUsaha->id)->get();
        }
        
        return view('seller.custom', compact('existingUsaha', 'links'));
    }


    public function nameStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'user_id' => 'unique:custom_nama_usahas,user_id',
        ]);

        $input = $request->all();

        $input['user_id'] = Auth::id();

        CustomNamaUsaha::create($input);

        return redirect()->route('seller.custom')->with('success', 'Nama berhasil ditambahkan');
    }

    public function linkStore(Request $request)
    {
        $request->validate([
            'name.*' => 'required|string',
        ]);

        $existingUsaha = CustomNamaUsaha::where('user_id', Auth::id())->first();

        if (!$existingUsaha) {
            return redirect()->route('seller.custom')->with('error', 'Nama usaha belum dibuat.');
        }

        foreach ($request->input('name') as $name) {
            $formattedUrl = '#' . strtolower(str_replace(' ', '', $name));
            
            CustomNavLink::create([
                'name' => $name,
                'url' => $formattedUrl,
                'usaha_id' => $existingUsaha->id,
            ]);
        }

        return redirect()->route('seller.custom')->with('success', 'Link navbar berhasil ditambahkan!');
}
}
