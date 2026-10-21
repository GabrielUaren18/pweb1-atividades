# Questão 03: Métodos e `$this`

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `aluno.php` | Fornecido com os métodos a completar |

## 1. Análise do código

**1.1 Cole o código dos três métodos que você escreveu e explique cada um.**

**Método `calcularMedia()`:**

```php
public function calcularMedia(): float
{
    return ($this->nota1 + $this->nota2) / 2;
}
```

Esse método soma as duas notas do aluno, divide por 2 e devolve a média.

**Método `situacao()`:**

```php
public function situacao(): string
{
    $media = $this->calcularMedia();

    if ($media >= 7) {
        return "Aprovado";
    } elseif ($media >= 4) {
        return "Recuperação";
    } else {
        return "Reprovado";
    }
}
```

Esse método verifica a média do aluno. Se for 7 ou mais, ele está aprovado. Se for de 4 até menos de 7, fica de recuperação. Abaixo de 4, está reprovado.

**Método `apresentar()`:**

```php
public function apresentar(): void
{
    $media = number_format($this->calcularMedia(), 1, ',', '.');

    echo "{$this->nome}: média $media ({$this->situacao()})\n";
}
```

Esse método mostra o nome, a média e a situação do aluno no terminal. O `number_format()` deixa a média com uma casa decimal.

**1.2 Classifique os três métodos: de ação, com retorno, com parâmetros, modificador ou de consulta? Justifique.**

O `calcularMedia()` e o `situacao()` são métodos de consulta com retorno, porque pegam informações do aluno e devolvem um resultado sem modificar os dados.

Já o `apresentar()` é um método de ação, porque mostra as informações no terminal usando `echo`.

Nenhum deles recebe parâmetros ou modifica os dados do aluno.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída de**: `php q03-metodos-this/aluno.php`

```text
Ana: média 8,8 (Aprovado)
Bruno: média 5,5 (Recuperação)
Caio: média 2,8 (Reprovado)
```

**Explicação:**

O programa calculou as médias dos três alunos e mostrou a situação de cada um. A Ana passou, o Bruno ficou de recuperação e o Caio foi reprovado.

**2.2 Saída com o quarto aluno (notas 6,5 e 7,5)**

```text
Ana: média 8,8 (Aprovado)
Bruno: média 5,5 (Recuperação)
Caio: média 2,8 (Reprovado)
Gabriel: média 7,0 (Aprovado)
```

**Explicação:**

Adicionei meu nome como quarto aluno e coloquei as notas 6,5 e 7,5. A média ficou 7,0 e o programa mostrou que fui aprovado.

## 3. Perguntas

**a) Por que `situacao()` chama `$this->calcularMedia()` em vez de repetir a conta?**

Porque a conta da média já está pronta no outro método. Assim, não preciso repetir o mesmo código e fica mais fácil de corrigir ou mudar depois.

**b) Com média exatamente 7,0, qual é a situação? Qual linha do código decide isso?**

É aprovado, porque a condição `if ($media >= 7)` aceita médias maiores ou iguais a 7.

**c) O método `apresentar()` foi escrito uma vez. Como ele sabe se deve mostrar a Ana ou o Bruno?**

Por causa do `$this`, que pega os dados do próprio aluno. Quando chamo `$ana->apresentar()`, ele mostra a Ana. Quando chamo `$bruno->apresentar()`, mostra o Bruno.