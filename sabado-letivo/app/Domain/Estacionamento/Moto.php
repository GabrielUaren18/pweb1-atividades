<?php

declare(strict_types=1);

namespace App\Domain\Estacionamento;

use InvalidArgumentException;

class Moto extends Veiculo
{
    public function tipo(): string
    {
        return 'moto';
    }

    public function calcularTarifa(float $horas): float
    {
        if ($horas <= 0) {
            throw new InvalidArgumentException('O tempo deve ser maior que zero.');
        }
        return $horas * 3.0;
    }
}
