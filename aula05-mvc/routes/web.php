<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sobre', function () {
    return 'O Estacionamento Campus organiza a entrada e a saída de veículos.';
});

Route::get('/contato', function () {
    return view('contato');
});
