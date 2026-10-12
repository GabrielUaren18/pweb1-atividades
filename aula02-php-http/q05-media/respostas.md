# Questão 05: Média com dados da URL

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `media.php` | Código fornecido, modificado no item 1.2 |

## 1. Análise do código

**1.1 Explique o código original: o que fazem `const`, os parênteses no cálculo e o operador `? :`?**

O `const` guarda a média mínima pra passar, que é 7. Os parênteses fazem a soma das notas antes da divisão. Já o `? :` verifica se o aluno foi aprovado ou ficou de recuperação.

**1.2 Modifique o código para receber as notas pela URL (`?n1=...&n2=...`), usando `??` com valor padrão `0` e convertendo para `float`. Cole aqui o trecho que você alterou e explique.**

```php
$n1 = (float) ($_GET['n1'] ?? 0);
$n2 = (float) ($_GET['n2'] ?? 0);
```

Agora o PHP pega as notas pela URL usando `$_GET`. O `??` coloca 0 quando alguma nota não é enviada, e o `(float)` converte os valores em números decimais.

## 2. Saídas do terminal

**2.1 Saída de `curl.exe -s "http://localhost:8000/q05-media/media.php?n1=5&n2=6"`**

```text
<p>Notas: 5 e 6</p>
<p>Média: 5.5</p>
<p>Situação: Em recuperação</p>
```

**Explicação linha por linha:**

- A primeira mostra as notas 5 e 6.
- A segunda mostra a média 5.5.
- A terceira mostra que o aluno ficou de recuperação porque a média foi menor que 7.

**2.2 Saída de `curl.exe -s "http://localhost:8000/q05-media/media.php?n1=9"`**

```text
<p>Notas: 9 e 0</p>
<p>Média: 4.5</p>
<p>Situação: Em recuperação</p>
```

**Explicação linha por linha:**

- A primeira mostra a nota 9 e a segunda como 0.
- A segunda mostra a média 4.5.
- A terceira mostra que o aluno ficou de recuperação porque não atingiu a média 7.

**2.3 Log do servidor das duas requisições acima**

```text
[Sun Oct 11 21:06:47 2026] [::1]:64478 Accepted
[Sun Oct 11 21:06:47 2026] [::1]:64478 [200]: GET /q05-media/media.php?n1=5&n2=6
[Sun Oct 11 21:06:47 2026] [::1]:64478 Closing
[Sun Oct 11 21:06:53 2026] [::1]:53616 Accepted
[Sun Oct 11 21:06:53 2026] [::1]:53616 [200]: GET /q05-media/media.php?n1=9
[Sun Oct 11 21:06:53 2026] [::1]:53616 Closing
```

**Explicação linha por linha:**

- A primeira mostra que a primeira conexão foi aberta.
- A segunda mostra a requisição com as notas 5 e 6, respondida com status 200.
- A terceira mostra que a conexão foi fechada.
- A quarta mostra que outra conexão foi aberta.
- A quinta mostra a requisição com a nota 9, também respondida com status 200.
- A sexta mostra que a segunda conexão foi fechada.

## 3. Perguntas

**3.1 No log, onde aparecem os valores das notas? Que parte da URL é essa?**

As notas aparecem depois do `?`, como em `n1=5&n2=6`. Essa parte da URL é chamada de *query string*.

**3.2 Na requisição 2.2, a nota 2 não foi enviada. Qual valor o código usou? Qual operador garantiu isso?**

O código usou 0, porque a segunda nota não foi enviada. Quem garantiu isso foi o operador `??`.

**3.3 O que acontece com `?n1=abc&n2=10`? Explique o papel do `(float)`.**

O PHP transforma `abc` em 0, porque não é um número. A média fica 5, e o aluno fica de recuperação. O `(float)` serve pra converter o valor recebido em número decimal.