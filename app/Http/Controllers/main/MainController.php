<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('main.about');
    }

    public function blog()
    {
        return view('main.blog');
    }

    public function contact()
    {
        return view('main.contact');
    }

    public function feature()
    {
        return view('main.feature');
    }

    public function pricing()
    {
        return view('main.pricing');
    }

    public function service()
    {
        return view('main.service');
    }

    public function testimonial()
    {
        return view('main.testimonial');
    }

    public function login()
    {
        return view('auth.login2');
    }

}
