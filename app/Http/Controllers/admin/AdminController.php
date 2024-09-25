<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function contact()
    {
        $contact = Contact::latest()->paginate(5);

        $data = [
            'contact' => $contact,
        ];

        return view('admin.contact', $data);
    }
}
