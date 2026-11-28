<?php

use Illuminate\Support\Facades\Route;
use App\Domain\Estacionamento\Carro;
use App\Http\Controllers\VeiculoController;

Route::get('/sobre', function () {
    return 'O Estacionamento Campus organiza veículos e calcula o valor da permanência.';
});

Route::get('/status', function () {
    return [
        'sistema' => 'Estacionamento Campus',
        'tema' => 'Tema 08: gestão de estacionamento',
        'autor' => 'Gabriel Uaren',
        'versao' => '1.0',
    ];
});

Route::get('/simular/{quantidade}', function (float $quantidade) {
    $veiculo = new Carro('ABC1D23', 'Sedan');
    $total = number_format($veiculo->calcularTarifa($quantidade), 2, ',', '.');

    return "{$quantidade} hora(s) no carro {$veiculo->getPlaca()} custam R$ {$total}";
})->where('quantidade', '[0-9]+(\.[0-9]+)?');

Route::get('/manutencao', function () {
    return response('Sistema em manutenção', 503);
});

Route::get('/inicio', fn () => redirect('/', 302));

Route::get('/', function () {
    return view('inicio', [
        'sistema' => 'Estacionamento Campus',
        'tema' => 'Tema 08: gestão de veículos no estacionamento',
    ]);
})->name('inicio');

Route::get('/veiculos', [VeiculoController::class, 'index'])->name('veiculos.index');
Route::get('/veiculos/novo', [VeiculoController::class, 'create'])->name('veiculos.create');
Route::post('/veiculos', [VeiculoController::class, 'store'])->name('veiculos.store');
Route::get('/veiculos/json', [VeiculoController::class, 'json'])->name('veiculos.json');
Route::get('/veiculos/{indice}', [VeiculoController::class, 'show'])
    ->whereNumber('indice')
    ->name('veiculos.show');

Route::fallback(function () {
    return response()->view('nao-encontrada', [], 404);
});
