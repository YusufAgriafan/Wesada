<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KonsultasiSellerController extends Controller
{
    public function index()
    {
        return view('seller.konsultasi');
    }
}