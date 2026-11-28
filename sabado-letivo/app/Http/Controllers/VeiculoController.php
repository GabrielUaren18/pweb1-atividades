<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Domain\Estacionamento\Veiculo;
use App\Domain\Estacionamento\Carro;
use App\Domain\Estacionamento\Moto;
use App\Domain\Estacionamento\Caminhonete;

class VeiculoController extends Controller
{
    private function criar(array $dados): Veiculo
    {
        return match ($dados['tipo']) {
            'carro' => new Carro($dados['placa'], $dados['modelo']),
            'moto' => new Moto($dados['placa'], $dados['modelo']),
            'caminhonete' => new Caminhonete($dados['placa'], $dados['modelo']),
            default => throw new InvalidArgumentException('Tipo de veículo inválido.'),
        };
    }

    private function itens(): array
    {
        $fixos = [
            new Carro('ABC1D23', 'Sedan'),
            new Moto('XYZ2E34', 'CG 160'),
            new Caminhonete('BRA3F45', 'Hilux'),
        ];

        $cadastrados = array_map(
            fn (array $dados) => $this->criar($dados),
            session('veiculos', [])
        );

        return array_merge($fixos, $cadastrados);
    }

    public function index()
    {
        return view('veiculos.index', ['veiculos' => $this->itens()]);
    }

    public function show(int $indice)
    {
        $veiculos = $this->itens();
        if (! array_key_exists($indice, $veiculos)) {
            abort(404);
        }

        return view('veiculos.show', ['veiculo' => $veiculos[$indice]]);
    }

    public function json()
    {
        $dados = array_map(
            fn (Veiculo $veiculo) => $veiculo->paraArray(),
            $this->itens()
        );
        return response()->json($dados);
    }

    public function create()
    {
        return view('veiculos.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'tipo' => 'required|in:carro,moto,caminhonete',
            'placa' => 'required|min:7',
            'modelo' => 'required|min:2',
        ]);

        try {
            $veiculo = $this->criar($dados);
        } catch (InvalidArgumentException $e) {
            return back()
                ->withErrors(['placa' => $e->getMessage()])
                ->withInput();
        }

        session()->push('veiculos', $dados);

        return redirect()->route('veiculos.index')
            ->with('sucesso', "{$veiculo->getPlaca()} cadastrada!");
    }
}
