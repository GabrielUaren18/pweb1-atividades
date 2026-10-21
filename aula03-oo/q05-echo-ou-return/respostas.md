# Questão 05: `echo` ou `return`?

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `retangulo.php` | Fornecido com métodos que imprimem. Você refatora |

## 1. Análise do código

**1.1 Cole a versão refatorada da classe e explique o que mudou em cada método.**

```php
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
```

Nos métodos `area()` e `perimetro()`, troquei o `echo` pelo `return` e o `void` pelo `float`. Agora eles devolvem os resultados, em vez de apenas mostrar na tela.

Também adicionei o atributo `$nome` para identificar cada ambiente e criei o método `ehQuadrado()`, que verifica se a largura e a altura são iguais. Se forem, devolve `true`; caso contrário, devolve `false`.

**1.2 Explique como o total da área foi calculado no `foreach`.**

Primeiro, criei a variável `$areaTotal` começando com zero. Depois, usei o `foreach` para passar pelos três ambientes. A cada repetição, o programa chama o método `area()` e soma o resultado na variável `$areaTotal` usando `+=`.

No final, a soma ficou 48 + 49 + 108 = 205 m².

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída do código original**: `php q05-echo-ou-return/retangulo.php`

```text
Área: 48
Perímetro: 28
```

**Explicação:**

O programa calculou a área e o perímetro da sala, que tem largura 8 e altura 6. A área deu 48 e o perímetro deu 28. Os dois resultados apareceram porque os métodos usavam `echo`.

**2.2 Saída do teste `var_dump($sala->area())` na versão original (item 2)**

```text
Área: 48
Perímetro: 28
Área: 48
NULL
```

**Explicação:**

A área apareceu novamente porque o método `area()` usa `echo`. Já o `NULL` apareceu porque esse método não devolvia nenhum valor com `return`.

**2.3 Saída da versão refatorada**

```text
Sala de aula: 48 m2 (retângulo)
Laboratório: 49 m2 (quadrado)
Biblioteca: 108 m2 (retângulo)
Área total: 205 m2
Rodapé necessário na biblioteca: 42 m
```

**Explicação:**

O programa mostrou a área dos três ambientes e identificou se cada um é quadrado ou retângulo. Depois, somou as áreas, chegando a 205 m². Por último, calculou o perímetro da biblioteca, que deu 42 metros de rodapé.

## 3. Perguntas

**a) O que um método `void` devolve? Use a saída 2.2 para responder.**

Um método `void` não devolve nenhum valor. No teste 2.2, o método mostrou `Área: 48`, mas o `var_dump()` mostrou `NULL`, porque ele só imprimia o resultado e não usava `return`.

**b) Por que não dava para somar as áreas na versão original?**

Porque o método `area()` usava `echo`, que apenas mostrava o resultado na tela. Como ele não devolvia o número, não dava para usar diretamente esse resultado na soma. Com `return`, conseguimos somar as áreas normalmente.

**c) Cite uma situação em que um método com `echo` faz sentido.**

Quando queremos apenas mostrar uma mensagem na tela, como uma saudação ou um aviso para o usuário, sem precisar usar aquele resultado em outro cálculo.