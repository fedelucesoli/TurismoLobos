<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function __construct()
    {

    }

    public function eventos()
    {
        $data['eventos'] = \App\Models\Evento::where('activo', true)->get();
        return view('paginas.eventos')->with($data);
    }
}
