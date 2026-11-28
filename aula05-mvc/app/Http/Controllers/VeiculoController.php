<?php

namespace App\Http\Controllers;

use App\Domain\Estacionamento\Caminhonete;
use App\Domain\Estacionamento\Carro;
use App\Domain\Estacionamento\Moto;
use App\Domain\Estacionamento\Van;
use App\Domain\Estacionamento\Veiculo;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{
    /**
     * @return list<Veiculo>
     */
    private function veiculos(): array
    {
        $exemplos = [
            new Carro('ABC1D23', 'Sedan'),
            new Moto('XYZ2E34', 'CG 160'),
            new Caminhonete('BRA3F45', 'Hilux'),
            new Van('QRS4G56', 'Sprinter'),
        ];

        $cadastrados = array_map(
            fn (array $dados): Veiculo => $this->instanciar($dados),
            session('cadastrados', []),
        );

        return [...$exemplos, ...$cadastrados];
    }

    /**
     * @param  array{placa: string, modelo: string, tipo: string}  $dados
     */
    private function instanciar(array $dados): Veiculo
    {
        return match ($dados['tipo']) {
            'carro' => new Carro($dados['placa'], $dados['modelo']),
            'moto' => new Moto($dados['placa'], $dados['modelo']),
            'caminhonete' => new Caminhonete($dados['placa'], $dados['modelo']),
            'van' => new Van($dados['placa'], $dados['modelo']),
        };
    }

    public function index(): View
    {
        return view('produtos.index', ['veiculos' => $this->veiculos()]);
    }

    public function create(): View
    {
        return view('produtos.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $dados = $request->validate([
            'tipo' => ['required', 'in:carro,moto,caminhonete,van'],
            'placa' => ['required', 'string', 'min:7', 'max:10'],
            'modelo' => ['required', 'string', 'min:2', 'max:100'],
            'horas' => ['required', 'numeric', 'gt:0'],
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'in' => 'Selecione um tipo de veículo válido.',
            'min.string' => 'O campo :attribute deve ter pelo menos :min caracteres.',
            'max.string' => 'O campo :attribute não pode ter mais de :max caracteres.',
            'numeric' => 'O campo :attribute deve ser numérico.',
            'gt.numeric' => 'O campo :attribute deve ser maior que :value.',
        ], [
            'tipo' => 'tipo',
            'placa' => 'placa',
            'modelo' => 'modelo',
            'horas' => 'tempo previsto',
        ]);

        $veiculo = $this->instanciar($dados);
        $registro = [
            ...$veiculo->paraArray(),
            'horas' => (float) $dados['horas'],
        ];

        session()->push('cadastrados', $registro);

        return redirect()
            ->route('produtos.index')
            ->with('sucesso', "Veículo {$veiculo->getPlaca()} cadastrado com sucesso.");
    }

    public function show(int $id): View
    {
        $veiculos = $this->veiculos();
        abort_unless(array_key_exists($id, $veiculos), 404);

        return view('produtos.show', ['veiculo' => $veiculos[$id]]);
    }
}
