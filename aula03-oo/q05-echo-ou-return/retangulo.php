<?php

declare(strict_types=1);

// Questão 05 - os métodos imprimem. Refatore para que devolvam o valor.
class Retangulo
{
    public float $largura;
    public float $altura;
    public string $nome;

    public function area(): float
    {
        return $this->largura * $this->altura;
    }
    public function perimetro(): float
    {
        return 2 * ($this->largura + $this->altura);
    }

    public function ehQuadrado(): bool
{
    return $this->largura == $this->altura;
}

}

$sala = new Retangulo();
$sala->nome = "Sala de aula";
$sala->largura = 8;
$sala->altura = 6;

$laboratorio = new Retangulo();
$laboratorio->nome = "Laboratório";
$laboratorio->largura = 7;
$laboratorio->altura = 7;

$biblioteca = new Retangulo();
$biblioteca->nome = "Biblioteca";
$biblioteca->largura = 12;
$biblioteca->altura = 9;


$ambientes = [$sala, $laboratorio, $biblioteca];
$areaTotal = 0;


foreach ($ambientes as $ambiente) {
    if ($ambiente->ehQuadrado()) {
        $tipo = "quadrado";
    } else {
        $tipo = "retângulo";
    }

    $areaTotal = $areaTotal + $ambiente->area();

    echo $ambiente->nome . ": " . $ambiente->area() . " m2 ($tipo)\n";
}

echo "Área total: $areaTotal m2\n";

echo "Rodapé necessário na biblioteca: " . $biblioteca->perimetro() . " m\n";