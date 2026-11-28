<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PaginaController extends Controller
{
    public function inicio(): View
    {
        return view('inicio');
    }

    public function sobre(): View
    {
        return view('sobre');
    }

    public function contato(): View
    {
        return view('contato');
    }
}
