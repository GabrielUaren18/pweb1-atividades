<?php

use App\Http\Controllers\PaginaController;
use App\Http\Controllers\VeiculoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PaginaController::class, 'inicio'])->name('inicio');

Route::get('/quem-somos', [PaginaController::class, 'sobre'])->name('sobre');

Route::get('/contato', [PaginaController::class, 'contato'])->name('contato');

Route::get('/inicio', function () {
    return redirect('/');
});

Route::get('/produtos', [VeiculoController::class, 'index'])->name('produtos.index');
Route::get('/produtos/create', [VeiculoController::class, 'create'])->name('produtos.create');
Route::post('/produtos', [VeiculoController::class, 'store'])->name('produtos.store');
Route::get('/produtos/{id}', [VeiculoController::class, 'show'])
    ->whereNumber('id')
    ->name('produtos.show');

Route::get('/saudacao/{nome?}', function (string $nome = 'visitante') {
    return "Olá, {$nome}!";
});

Route::post('/mensagem', function () {
    return 'Mensagem do Estacionamento Campus recebida.';
})->name('mensagem.store');

Route::fallback(function () {
    return response()->view('nao-encontrada', [], 404);
});
