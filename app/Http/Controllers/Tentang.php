<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Tentang extends Controller
{
    public function tampil()
    {
        return view('tentang.tampil');
    }
}
