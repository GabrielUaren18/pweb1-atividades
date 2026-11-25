<?php

namespace App\Http\Controllers;

class CardapioController extends Controller
{
    private function pratos(): array
    {
        return [
            ['nome' => 'Baião de dois', 'preco' => 18.0],
            ['nome' => 'Tapioca de queijo', 'preco' => 8.5],
            ['nome' => 'Cuscuz com ovo', 'preco' => 7.0],
            ['nome' => '<b>Panelada</b>', 'preco' => 12.0],
        ];
    }

    public function index()
    {
        return view('cardapio', ['pratos' => $this->pratos()]);
    }
}
