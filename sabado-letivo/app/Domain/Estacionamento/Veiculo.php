<?php

declare(strict_types=1);

namespace App\Domain\Estacionamento;

use InvalidArgumentException;

abstract class Veiculo
{
    private string $placa;
    private string $modelo;

    public function __construct(string $placa, string $modelo)
    {
        // Regra de negócio da classe mãe: placa e modelo são obrigatórios.
        if (trim($placa) === '' || trim($modelo) === '') {
            throw new InvalidArgumentException('Placa e modelo são obrigatórios.');
        }

        $this->placa = strtoupper(trim($placa));
        $this->modelo = trim($modelo);
    }

    public function getPlaca(): string
    {
        return $this->placa;
    }

    public function getModelo(): string
    {
        return $this->modelo;
    }

    abstract public function tipo(): string;

    // Cada classe filha implementa sua própria tarifa.
    abstract public function calcularTarifa(float $horas): float;

    public function paraArray(): array
    {
        return [
            'placa' => $this->placa,
            'modelo' => $this->modelo,
            'tipo' => $this->tipo(),
        ];
    }
}
