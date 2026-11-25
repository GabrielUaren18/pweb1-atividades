<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    private function produtos(): array
    {
        return [
            1 => ['nome' => 'Queijo coalho', 'categoria' => 'laticinios', 'estoque' => 12, 'preco' => 28.0],
            2 => ['nome' => 'Doce de leite', 'categoria' => 'doces', 'estoque' => 0, 'preco' => 15.0],
            3 => ['nome' => 'Mel silvestre', 'categoria' => 'mel', 'estoque' => 7, 'preco' => 20.0],
            4 => ['nome' => 'Requeijão', 'categoria' => 'laticinios', 'estoque' => 5, 'preco' => 18.0],
        ];
    }

    public function index()
    {
        return view('produtos.index', ['produtos' => $this->produtos()]);
    }

    public function show(int $id)
    {
        $produto = $this->produtos()[$id] ?? null;
        abort_if($produto === null, 404);

        return view('produtos.show', ['produto' => $produto, 'id' => $id]);
    }

    public function categoria(string $categoria)
    {
        $filtrados = array_filter(
            $this->produtos(),
            fn ($produto) => $produto['categoria'] === $categoria
        );

        abort_if($filtrados === [], 404);

        return view('produtos.index', ['produtos' => $filtrados]);
    }

    public function showJson(int $id)
    {
        $produto = $this->produtos()[$id] ?? null;

        if ($produto === null) {
            return response()->json(['erro' => "Produto {$id} não encontrado"], 404);
        }

        return response()->json(array_merge(['id' => $id], $produto), 200);
    }
}
