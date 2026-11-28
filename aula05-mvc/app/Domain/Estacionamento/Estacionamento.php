<?php

namespace App\Domain\Estacionamento;

use InvalidArgumentException;

final class Estacionamento
{
    /**
     * @param  list<Veiculo>  $veiculos
     */
    public function __construct(private string $nome, private array $veiculos)
    {
        if (trim($nome) === '') {
            throw new InvalidArgumentException('O nome do estacionamento é obrigatório.');
        }

        if ($veiculos === []) {
            throw new InvalidArgumentException('O estacionamento deve conter ao menos um veículo.');
        }

        $this->nome = trim($nome);
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @return list<Veiculo>
     */
    public function getVeiculos(): array
    {
        return $this->veiculos;
    }

    /**
     * @return array{nome: string, veiculos: list<array{placa: string, modelo: string, tipo: string}>}
     */
    public function paraArray(): array
    {
        return [
            'nome' => $this->nome,
            'veiculos' => array_map(
                fn (Veiculo $veiculo): array => $veiculo->paraArray(),
                $this->veiculos,
            ),
        ];
    }
}
