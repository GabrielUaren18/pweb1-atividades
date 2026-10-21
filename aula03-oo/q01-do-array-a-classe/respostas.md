# Questão 01: Do array à classe

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `livro-array.php` | Fornecido: o livro em array associativo |
| `livro.php` | Você cria: a classe `Livro` e dois objetos |

## 1. Análise do código

**1.1 Explique a declaração `public float $preco;`: o que é cada uma das três partes?**

O `public` significa que posso acessar o atributo fora da classe. O `float` é o tipo do valor, que é um número decimal. Já o `$preco` é o nome do atributo que guarda o preço do livro.

**1.2 Compare `$livro['titulo']` (array) e `$livro1->titulo` (objeto). O que muda na escrita e o que muda no que o PHP garante?**

No array eu uso colchetes e aspas pra acessar o título. Já no objeto eu uso a setinha `->`. Na classe eu também posso definir o tipo do atributo, então o PHP verifica se estou colocando o tipo certo de valor.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída de**: `php q01-do-array-a-classe/livro.php`

```text
Vidas Secas, de Graciliano Ramos (1938)
Iracema, de José de Alencar (1865)
object(Livro)#2 (5) {
  ["titulo"]=>
  string(7) "Iracema"
  ["autor"]=>
  string(16) "José de Alencar"
  ["ano"]=>
  int(1865)
  ["preco"]=>
  float(29.9)
  ["disponivel"]=>
  bool(true)
}
```

**Explicação:**

O programa mostrou os dois livros que eu criei. Depois o `var_dump` mostrou as informações do segundo livro, junto com o tipo de cada valor.

**2.2 Erro ao atribuir o ano como texto (item 5)**

```text
PHP Fatal error:  Uncaught TypeError: Cannot assign string to property Livro::$ano of type int in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q01-do-array-a-classe\livro.php:16
Stack trace:
#0 {main}
  thrown in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q01-do-array-a-classe\livro.php on line 16

Fatal error: Uncaught TypeError: Cannot assign string to property Livro::$ano of type int in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q01-do-array-a-classe\livro.php:16
Stack trace:
#0 {main}
  thrown in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q01-do-array-a-classe\livro.php on line 16
```

**Explicação:**

O erro aconteceu porque coloquei o ano entre aspas, aí o PHP entendeu como texto. Só que o atributo `$ano` foi definido como número inteiro. Pra resolver, tirei as aspas e deixei o número normal.

## 3. Perguntas

**a) Quantas classes e quantos objetos existem no seu `livro.php`?**

Tem 1 classe chamada `Livro` e 2 objetos, que são os livros Vidas Secas e Iracema.

**b) No `var_dump`, o que significam `object(Livro)#2` e o `(5)`?**

O `object(Livro)` mostra que é um objeto da classe Livro. O `#2` é o número que o PHP usa pra identificar esse objeto durante a execução, e o `(5)` significa que ele tem 5 atributos.

**c) O que o `declare(strict_types=1)` mudou no resultado do item 5?**

Nesse teste ele não mudou o erro, porque o PHP já não aceita colocar um texto direto num atributo do tipo `int`, mesmo sem o `strict_types`. Esse comando serve principalmente pra deixar a verificação de tipos mais rígida quando a gente passa valores para funções.