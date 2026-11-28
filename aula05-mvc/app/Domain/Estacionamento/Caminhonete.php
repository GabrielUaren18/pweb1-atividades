<?php

namespace App\Domain\Estacionamento;

class Caminhonete extends Veiculo
{
    public function tipo(): string
    {
        return 'caminhonete';
    }

    public function calcularTarifa(float $horas): float
    {
        $this->validarHoras($horas);

        return $horas * 8.0;
    }
}
