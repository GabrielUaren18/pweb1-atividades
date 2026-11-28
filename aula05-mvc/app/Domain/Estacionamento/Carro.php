<?php

namespace App\Domain\Estacionamento;

class Carro extends Veiculo
{
    public function tipo(): string
    {
        return 'carro';
    }

    public function calcularTarifa(float $horas): float
    {
        $this->validarHoras($horas);

        return $horas * 6.0;
    }
}
