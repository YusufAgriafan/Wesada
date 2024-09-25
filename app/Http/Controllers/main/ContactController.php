<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
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
}
