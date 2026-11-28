<?php

namespace App\Http\Controllers;

use App\Domain\Estacionamento\Estacionamento;
use App\Domain\Estacionamento\Veiculo;
use App\Domain\Estacionamento\VeiculoFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EstacionamentoController extends Controller
{
    /**
     * @return array<int, array{id: int, nome: string, veiculos: list<array{placa: string, modelo: string, tipo: string}>}>
     */
    private function registros(): array
    {
        return session('estacionamentos', []);
    }

    /**
     * @param  array{id: int, nome: string, veiculos: list<array{placa: string, modelo: string, tipo: string}>}  $registro
     */
    private function hidratar(array $registro): Estacionamento
    {
        $veiculos = array_map(
            fn (array $dados): Veiculo => VeiculoFactory::criar($dados),
            $registro['veiculos'],
        );

        return new Estacionamento($registro['nome'], $veiculos);
    }

    public function index(): View
    {
        $estacionamentos = array_map(
            fn (array $registro): array => [
                'id' => $registro['id'],
                'estacionamento' => $this->hidratar($registro),
            ],
            $this->registros(),
        );

        return view('estacionamentos.index', ['estacionamentos' => array_values($estacionamentos)]);
    }

    public function create(): View
    {
        return view('estacionamentos.create', [
            'estacionamento' => null,
            'veiculos' => $this->catalogo(),
            'veiculosSelecionados' => [],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $dados = $this->validarDados($request);
        $estacionamento = $this->criarEstacionamento($dados);
        $registro = ['id' => $this->proximoId(), ...$estacionamento->paraArray()];
        $registros = $this->registros();
        $registros[$registro['id']] = $registro;
        session(['estacionamentos' => $registros]);

        return redirect()
            ->route('estacionamentos.show', $registro['id'])
            ->with('sucesso', "{$estacionamento->getNome()} cadastrado com sucesso.");
    }

    public function edit(int $estacionamento): View
    {
        $registro = $this->registro($estacionamento);
        $objeto = $this->hidratar($registro);

        return view('estacionamentos.create', [
            'estacionamento' => $objeto,
            'veiculos' => $this->catalogo(),
            'veiculosSelecionados' => array_map(
                fn (Veiculo $veiculo): string => $veiculo->getPlaca(),
                $objeto->getVeiculos(),
            ),
            'estacionamentoId' => $estacionamento,
        ]);
    }

    public function show(int $estacionamento): View
    {
        return view('estacionamentos.show', [
            'id' => $estacionamento,
            'estacionamento' => $this->hidratar($this->registro($estacionamento)),
        ]);
    }

    public function update(Request $request, int $estacionamento): RedirectResponse
    {
        $this->registro($estacionamento);
        $dados = $this->validarDados($request);
        $objeto = $this->criarEstacionamento($dados);
        $registro = ['id' => $estacionamento, ...$objeto->paraArray()];
        $registros = $this->registros();
        $registros[$estacionamento] = $registro;
        session(['estacionamentos' => $registros]);

        return redirect()
            ->route('estacionamentos.show', $estacionamento)
            ->with('sucesso', "{$objeto->getNome()} atualizado com sucesso.");
    }

    public function destroy(int $estacionamento): RedirectResponse
    {
        $registros = $this->registros();
        $registro = $this->registro($estacionamento);

        $nome = $registro['nome'];
        unset($registros[$estacionamento]);
        session(['estacionamentos' => $registros]);

        return redirect()
            ->route('estacionamentos.index')
            ->with('sucesso', "Estacionamento {$nome} excluído com sucesso.");
    }

    /**
     * @return list<Veiculo>
     */
    private function catalogo(): array
    {
        return VeiculoFactory::catalogo(session('cadastrados', []));
    }

    /**
     * @return array{nome: string, veiculos: list<string>}
     */
    private function validarDados(Request $request): array
    {
        $placasDisponiveis = array_map(
            fn (Veiculo $veiculo): string => $veiculo->getPlaca(),
            $this->catalogo(),
        );

        return $request->validate([
            'nome' => ['required', 'string', 'min:3', 'max:100'],
            'veiculos' => ['required', 'array', 'min:1'],
            'veiculos.*' => ['required', 'string', 'distinct', Rule::in($placasDisponiveis)],
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'min.string' => 'O campo :attribute deve ter pelo menos :min caracteres.',
            'min.array' => 'Selecione ao menos :min veículo.',
            'in' => 'Um dos veículos selecionados não é válido.',
            'distinct' => 'Não repita o mesmo veículo.',
        ], [
            'nome' => 'nome do estacionamento',
            'veiculos' => 'veículos',
            'veiculos.*' => 'veículo',
        ]);
    }

    /**
     * @param  array{nome: string, veiculos: list<string>}  $dados
     */
    private function criarEstacionamento(array $dados): Estacionamento
    {
        $selecionados = array_values(array_filter(
            $this->catalogo(),
            fn (Veiculo $veiculo): bool => in_array($veiculo->getPlaca(), $dados['veiculos'], true),
        ));

        return new Estacionamento($dados['nome'], $selecionados);
    }

    /**
     * @return array{id: int, nome: string, veiculos: list<array{placa: string, modelo: string, tipo: string}>}
     */
    private function registro(int $id): array
    {
        $registro = $this->registros()[$id] ?? null;
        abort_unless(is_array($registro), 404);

        return $registro;
    }

    private function proximoId(): int
    {
        $ids = array_keys($this->registros());

        return $ids === [] ? 1 : max($ids) + 1;
    }
}
