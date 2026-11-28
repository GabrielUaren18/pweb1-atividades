<?php

namespace App\Http\Controllers;

use App\Domain\Estacionamento\Caminhonete;
use App\Domain\Estacionamento\Carro;
use App\Domain\Estacionamento\Moto;
use App\Domain\Estacionamento\Van;
use App\Domain\Estacionamento\Veiculo;
use Illuminate\Contracts\View\View;

class VeiculoController extends Controller
{
    /**
     * @return list<Veiculo>
     */
    private function veiculos(): array
    {
        return [
            new Carro('ABC1D23', 'Sedan'),
            new Moto('XYZ2E34', 'CG 160'),
            new Caminhonete('BRA3F45', 'Hilux'),
            new Van('QRS4G56', 'Sprinter'),
        ];
    }

    public function index(): View
    {
        return view('produtos.index', ['veiculos' => $this->veiculos()]);
    }

    public function show(int $id): View
    {
        $veiculos = $this->veiculos();
        abort_unless(array_key_exists($id, $veiculos), 404);

        return view('produtos.show', ['veiculo' => $veiculos[$id]]);
    }
}
