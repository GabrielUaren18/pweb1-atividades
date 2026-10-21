# Questão 06: Construtor

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `produto.php` | O Produto da aula. Você acrescenta o construtor |
| `teste-erros.php` | Fornecido: três criações erradas, uma de cada vez |

## 1. Análise do código

**1.1 Cole o seu construtor e explique cada linha.**

```php
public function __construct(string $nome, float $preco, int $quantidade = 1)
{
    $this->nome = $nome;
    $this->preco = $preco;
    $this->quantidade = $quantidade;
}
```

O `__construct()` é um método que funciona automaticamente quando criamos um produto usando `new`.

Na primeira linha, informamos que o produto precisa receber um nome, um preço e uma quantidade.

Depois, `$this->nome = $nome` guarda o nome no objeto. A linha `$this->preco = $preco` guarda o preço e `$this->quantidade = $quantidade` guarda a quantidade.

**1.2 Explique o `= 1` no parâmetro `$quantidade`.**

O `= 1` significa que a quantidade tem um valor padrão. Se não informarmos a quantidade ao criar um produto, o PHP coloca 1 automaticamente.

Foi o que aconteceu com o Monitor, que criamos sem informar a quantidade e apareceu com 1 unidade.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída de:** `php q06-construtor/produto.php`

```text
Produto: Notebook
Preço unitário: R$ 3.500,00
Quantidade: 3
Total: R$ 10.500,00
Produto: Mouse
Preço unitário: R$ 59,90
Quantidade: 10
Total: R$ 599,00
Produto: Monitor
Preço unitário: R$ 899,00
Quantidade: 1
Total: R$ 899,00
Total do pedido: R$ 11.998,00
```

**Explicação:**

O programa criou três produtos usando o construtor e mostrou o nome, o preço, a quantidade e o total de cada um.

Depois, o `foreach` passou pelos produtos e somou os valores. No final, o pedido ficou em R$ 11.998,00.

**2.2 Erro com `new Produto('Teclado')`:** `php q06-construtor/teste-erros.php`

```text
--- testes ---
PHP Fatal error: Uncaught ArgumentCountError: Too few arguments to function Produto::__construct(), 1 passed in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q06-construtor\teste-erros.php on line 9 and at least 2 expected in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q06-construtor\produto.php:12
```

**Explicação:**

O erro aconteceu porque tentei criar um produto informando apenas o nome, mas o construtor exige pelo menos o nome e o preço.

**2.3 Erro com `new Produto('Teclado', 'cem reais', 2)`**

```text
--- testes ---
PHP Fatal error: Uncaught TypeError: Produto::__construct(): Argument #2 ($preco) must be of type float, string given, called in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q06-construtor\teste-erros.php on line 10 and defined in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q06-construtor\produto.php:12
```

**Explicação:**

O erro aconteceu porque coloquei `'cem reais'` como preço. Só que o construtor espera um número do tipo `float`, e eu passei um texto (`string`).

**2.4 Erro com `new Produto()`**

```text
--- testes ---
PHP Fatal error: Uncaught ArgumentCountError: Too few arguments to function Produto::__construct(), 0 passed in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q06-construtor\teste-erros.php on line 11 and at least 2 expected in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q06-construtor\produto.php:12
```

**Explicação:**

Nesse teste, tentei criar um produto sem informar nenhum valor. Como o nome e o preço são obrigatórios, o PHP mostrou um erro por falta de argumentos.

## 3. Perguntas

**a) A mensagem diz "at least 2 expected", e não "exactly 3". Por quê?**

Porque o nome e o preço são obrigatórios, mas a quantidade é opcional, já que tem o valor padrão `1`. Por isso, o construtor aceita dois ou três argumentos.

**b) Quem devolve o objeto pronto: o `__construct` ou o `new`?**

É o `new`. Ele cria o objeto e chama o `__construct()` para preencher os dados iniciais. O construtor não devolve o objeto usando `return`.

**c) Que erro da versão anterior (sem construtor) deixou de ser possível?**

Antes, dava para criar um produto e esquecer de preencher algum atributo, como o nome ou o preço. Agora, o construtor exige esses dados logo na criação, evitando que o produto seja criado sem eles.