<?php

use App\Http\Controllers\CardapioController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', ['paginaSobre' => null]);
})->name('inicio');

Route::get('/meu-nome', fn () => 'Meu nome é Gabriel Uaren e estudo ADS no IFCE');
Route::get('/cartao', fn () => '<h2>Gabriel Uaren</h2><p>Semestre: 6º semestre</p><ul><li>Programação</li><li>Jogos</li><li>Música</li></ul>');

Route::get('/perfil-json', fn () => [
    'nome' => 'Gabriel Uaren',
    'semestre' => 6,
    'media' => 8.5,
    'bolsista' => true,
    'disciplinas' => ['Programação Web I', 'Banco de Dados', 'Engenharia de Software'],
    'endereco' => ['cidade' => 'Boa Viagem', 'uf' => 'CE'],
]);
Route::get('/perfil-criado', fn () => response()->json([
    'nome' => 'Gabriel Uaren',
    'semestre' => 6,
    'media' => 8.5,
    'bolsista' => true,
    'disciplinas' => ['Programação Web I', 'Banco de Dados', 'Engenharia de Software'],
    'endereco' => ['cidade' => 'Boa Viagem', 'uf' => 'CE'],
], 201));

Route::get('/tabuada/{numero}', function (int $numero) {
    $saida = '';
    for ($i = 1; $i <= 10; $i++) {
        $saida .= "{$numero} x {$i} = ".$numero * $i.'<br>';
    }
    return $saida;
})->whereNumber('numero');

Route::get('/idade/{ano}', function (int $ano) {
    $anoAtual = (int) date('Y');
    $idade = $anoAtual - $ano;
    return "Quem nasceu em {$ano} tem ou vai fazer {$idade} anos em {$anoAtual}.";
})->whereNumber('ano');

Route::get('/boas-vindas-turma/{turma?}', fn ($turma = 'ADS') => "Bem-vinda, turma de {$turma}!");

Route::get('/admin', fn () => response('Área restrita', 403));
Route::get('/em-breve', fn () => response('Página em construção', 503));
Route::get('/loja', fn () => redirect('/feira-do-dia'))->name('loja');
Route::get('/feira', fn () => 'Página da feira')->name('feira');
Route::get('/feira-do-dia', fn () => 'Página da feira')->name('feira-dia');
Route::get('/produtos-antigos', fn () => redirect('/produtos', 301));
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');

Route::get('/cardapio-do-dia', [CardapioController::class, 'index'])->name('cardapio');

Route::get('/quem-somos', fn () => view('welcome', ['paginaSobre' => 'Feira Digital']))->name('sobre');
Route::get('/contato', fn () => 'Contato da Feira Digital')->name('contato');

Route::get('/produtos/categoria/{categoria}', [ProdutoController::class, 'categoria'])
    ->whereAlpha('categoria')
    ->name('produtos.categoria');
Route::get('/produtos/{id}/json', [ProdutoController::class, 'showJson'])
    ->whereNumber('id')
    ->name('produtos.show-json');
Route::get('/produtos/{id}', [ProdutoController::class, 'show'])
    ->whereNumber('id')
    ->name('produtos.show');

Route::get('/inscricao', [InscricaoController::class, 'create'])->name('inscricao.create');
Route::post('/inscricao', [InscricaoController::class, 'store'])->name('inscricao.store');

Route::fallback(function () {
    abort(404);
});
