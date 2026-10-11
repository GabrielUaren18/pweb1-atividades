# Questão 04: Tipos e conversões

**Nível:** 🟢 Básico

## 1. Análise do código

**1.1 Minha previsão e resultado real**

| Linha | Minha previsão | Resultado real |
|---|---|---|
| `"10" + 5` | `int(15)` | `int(15)` |
| `"10" . 5` | `string(3) "105"` | `string(3) "105"` |
| `7 / 2` | `float(3.5)` | `float(3.5)` |
| `7 % 2` | `int(1)` | `int(1)` |
| `(int) "3.9 kg"` | `int(3)` | `int(3)` |
| `(bool) "0"` | `bool(false)` | `bool(false)` |
| `(bool) "false"` | `bool(true)` | `bool(true)` |
| `0.1 + 0.2 == 0.3` | `bool(false)` | `bool(false)` |

## 2. Saídas do terminal

**2.1 Saída do curl**

```text
<pre>int(15)
string(3) "105"
float(3.5)
int(1)
int(3)
bool(false)
bool(true)
bool(false)
bool(true)
bool(false)
</pre>
```

**Explicação linha por linha:**

- `<pre>`: deixa tudo organizado.
- `int(15)`: somou 10 com 5.
- `string(3) "105"`: juntou 10 e 5, virando um texto.
- `float(3.5)`: dividiu 7 por 2 e deu 3,5.
- `int(1)`: sobrou 1 na divisão.
- `int(3)`: pegou o número 3 do texto e virou inteiro.
- `bool(false)`: o PHP entende `"0"` como falso.
- `bool(true)`: o PHP entende `"false"` como verdadeiro, porque é um texto.
- `bool(false)`: a conta com decimais não ficou exatamente igual a 0,3.
- `bool(true)`: os dois valores são iguais.
- `bool(false)`: os valores são iguais, mas os tipos são diferentes.
- `</pre>`: fecha o bloco.

## 3. Perguntas

**3.1 Explique a diferença entre `"10" + 5` e `"10" . 5`.**

O `+` soma os números e dá 15. Já o ponto (`.`) só junta os dois, ficando 105.

**3.2 Por que `(bool) "0"` é `false`, mas `(bool) "false"` é `true`?**

Porque o PHP trata `"0"` como falso. Já `"false"` é só uma palavra escrita, então ele considera verdadeiro.

**3.3 Acrescente duas linhas `var_dump` e explique cada uma.**

```php
var_dump("5" == 5);
var_dump("5" === 5);
```

A primeira deu `true`, porque os valores são iguais. A segunda deu `false`, porque um é texto e o outro é número.

Achei interessante porque, mesmo parecendo a mesma coisa, o PHP trata os dois de forma diferente.