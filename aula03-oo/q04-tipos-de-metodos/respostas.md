# Questão 04: Tipos de métodos

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `termostato.php` | Fornecido. Você acrescenta dois métodos no item 4 |

## 1. Análise do código

**1.1 ANTES de executar, classifique os métodos:**

| Método | Tipo de retorno | Recebe parâmetro? | Altera o objeto? | Tipo do método |
|---|---|---|---|---|
| `getTemperatura()` | `float` | Não | Não | Consulta, com retorno |
| `definirAlvo()` | `void` | Sim | Sim | Modificador, com parâmetro |
| `resfriar()` | `void` | Sim | Sim | Modificador, com parâmetro |
| `precisaResfriar()` | `bool` | Não | Não | Consulta, com retorno |
| `mostrarStatus()` | `void` | Não | Não | Ação |

**1.2 ANTES de executar, escreva as 5 linhas que você espera ver na saída:**

```text
Laboratório 1: 25 °C (alvo 22 °C) - resfriando
Laboratório 1: 23 °C (alvo 22 °C) - resfriando
Laboratório 1: 23 °C (alvo 24 °C) - ok
33
bool(false)
```

**1.3 Cole os dois métodos novos (`aquecer` e `diferencaParaAlvo`) e classifique cada um.**

**Método `aquecer()`:**

```php
public function aquecer(float $graus): void
{
    $this->temperatura += $graus;
}
```

É um método modificador com parâmetro, porque recebe a quantidade de graus e aumenta a temperatura do objeto. Não devolve nenhum valor.

**Método `diferencaParaAlvo()`:**

```php
public function diferencaParaAlvo(): float
{
    return $this->temperatura - $this->alvo;
}
```

É um método de consulta com retorno, porque calcula a diferença entre a temperatura atual e o alvo, sem modificar os valores.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída do código original**: `php q04-tipos-de-metodos/termostato.php`

```text
Laboratório 1: 25 °C (alvo 22 °C) - resfriando
Laboratório 1: 23 °C (alvo 22 °C) - resfriando
Laboratório 1: 23 °C (alvo 24 °C) - ok
33
bool(false)
```

**Explicação:**

O programa começou com 25 graus e alvo de 22, então precisava resfriar. Depois diminuiu 2 graus, ficando com 23. Quando mudei o alvo para 24, não precisava mais resfriar. O número 33 apareceu porque somou 10 à temperatura atual, e o `false` mostrou que não precisava resfriar.

**2.2 Saída com os métodos novos**

```text
Laboratório 1: 25 °C (alvo 22 °C) - resfriando
Laboratório 1: 23 °C (alvo 22 °C) - resfriando
Laboratório 1: 23 °C (alvo 24 °C) - ok
33
bool(false)
Laboratório 1: 28 °C (alvo 24 °C) - resfriando
4
```

**Explicação:**

Depois de criar os dois métodos, usei `aquecer(5)` para aumentar a temperatura de 23 para 28 graus. Como o alvo era 24, o programa mostrou que precisava resfriar novamente. A diferença ficou em 4 graus.

## 3. Perguntas

**a) Sua previsão do item 1.2 acertou todas as linhas? Explique cada diferença.**

Sim, acertei todas as cinco linhas. Não teve nenhuma diferença entre a previsão e o resultado do terminal.

**b) Por que `echo $sala->getTemperatura() + 10` funciona, mas `$sala->mostrarStatus() + 10` não faria sentido?**

Porque `getTemperatura()` devolve um número, então posso somar 10 nele. Já `mostrarStatus()` só mostra as informações na tela e não devolve um número para fazer a conta.

**c) Qual método chama outro método do mesmo objeto?**

O método `mostrarStatus()` chama `precisaResfriar()` usando `$this->precisaResfriar()` para verificar se a temperatura está acima do alvo.