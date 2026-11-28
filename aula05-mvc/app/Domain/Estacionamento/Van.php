<?php

namespace App\Domain\Estacionamento;

class Van extends Veiculo
{
    public function tipo(): string
    {
        return 'van';
    }

    public function calcularTarifa(float $horas): float
    {
        $this->validarHoras($horas);

        return $horas * 10.0;
    }
}
