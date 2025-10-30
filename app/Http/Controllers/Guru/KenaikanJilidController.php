<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;

class KenaikanJilidController extends Controller
{
    public function index()
    {
        return view('guru.kenaikan.index');
    }
}

