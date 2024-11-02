<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomNamaUsaha;
use App\Models\CustomNavLink;

class GuestController extends Controller
{
    public function index($name)
{
    $usaha = CustomNamaUsaha::where('name', $name)->firstOrFail();

    $navLinks = CustomNavLink::where('usaha_id', $usaha->id)->get();

    return view('custom.seller1', compact('usaha', 'navLinks'));
}

}
