<?php

namespace App\Domain\Estacionamento;

use InvalidArgumentException;

abstract class Veiculo
{
    public function __construct(private string $placa, private string $modelo)
    {
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

    abstract public function calcularTarifa(float $horas): float;

    /**
     * @return array{placa: string, modelo: string, tipo: string}
     */
    public function paraArray(): array
    {
        return [
            'placa' => $this->placa,
            'modelo' => $this->modelo,
            'tipo' => $this->tipo(),
        ];
    }

    protected function validarHoras(float $horas): void
    {
        if ($horas <= 0) {
            throw new InvalidArgumentException('O tempo deve ser maior que zero.');
        }
    }
}
