<?php

namespace App\Domain\Estacionamento;

final class VeiculoFactory
{
    /**
     * @param  array{placa: string, modelo: string, tipo: string}  $dados
     */
    public static function criar(array $dados): Veiculo
    {
        return match ($dados['tipo']) {
            'carro' => new Carro($dados['placa'], $dados['modelo']),
            'moto' => new Moto($dados['placa'], $dados['modelo']),
            'caminhonete' => new Caminhonete($dados['placa'], $dados['modelo']),
            'van' => new Van($dados['placa'], $dados['modelo']),
        };
    }

    /**
     * @param  list<array{placa: string, modelo: string, tipo: string}>  $cadastrados
     * @return list<Veiculo>
     */
    public static function catalogo(array $cadastrados = []): array
    {
        $exemplos = [
            new Carro('ABC1D23', 'Sedan'),
            new Moto('XYZ2E34', 'CG 160'),
            new Caminhonete('BRA3F45', 'Hilux'),
            new Van('QRS4G56', 'Sprinter'),
        ];

        $registrados = array_map(
            fn (array $dados): Veiculo => self::criar($dados),
            $cadastrados,
        );

        return [...$exemplos, ...$registrados];
    }
}
