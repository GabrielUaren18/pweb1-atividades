<?php

namespace App\Domain\Estacionamento;

class Moto extends Veiculo
{
    public function tipo(): string
    {
        return 'moto';
    }

    public function calcularTarifa(float $horas): float
    {
        $this->validarHoras($horas);

        return $horas * 3.0;
    }
}
