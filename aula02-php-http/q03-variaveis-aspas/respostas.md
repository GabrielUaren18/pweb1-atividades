# Questão 03: Variáveis, aspas e concatenação

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `aspas.php` | Código fornecido (não altere) |

## 1. Análise do código

**1.1 Antes de executar, preencha a coluna "Minha previsão" com o que cada linha vai mostrar.**

| Linha | Minha previsão | Resultado real |
|---|---|---|
| `"Aluna: " . $nome` | Aluna: Maria | Aluna: Maria |
| `"Aluna: $nome"` | Aluna: Maria | Aluna: Maria |
| `'Aluna: $nome'` | Aluna: $nome | Aluna: $nome |
| `"Cursa o {$semestre}º semestre de $curso"` | Cursa o 2º semestre de ADS | Cursa o 2º semestre de ADS |
| `$nome . $curso` | MariaADS | MariaADS |
| `<?= $nome ?>` | Maria | Maria |

**1.2 Para que servem as chaves `{}` em `{$semestre}`?**

Servem para separar a variável do restante do texto, deixando claro onde ela termina.

## 2. Saídas do terminal

**2.1 Saída de `curl.exe -s http://localhost:8000/q03-variaveis-aspas/aspas.php`**

```text
<p>Aluna: Maria</p>
<p>Aluna: Maria</p>
<p>Aluna: $nome</p>
<p>Cursa o 2º semestre de ADS</p>
<p>MariaADS</p>
<p>Atalho: Maria</p>
```

**Explicação linha por linha:**

- **Primeira linha:** juntou o texto com a variável `$nome`.
- **Segunda linha:** mostrou o valor de `$nome` dentro das aspas duplas.
- **Terceira linha:** mostrou `$nome` como texto, porque usou aspas simples.
- **Quarta linha:** mostrou o semestre e o curso usando as variáveis.
- **Quinta linha:** juntou o nome e o curso sem espaço.
- **Sexta linha:** usou o atalho `<?= ?>` para mostrar o nome.

## 3. Perguntas

**3.1 Em quais linhas sua previsão errou? Explique o motivo.**

Nenhuma. Todas as previsões estavam corretas e deram o mesmo resultado na execução.

**3.2 Por que `$nome . $curso` aparece sem espaço entre as palavras? Como corrigir?**

Porque o ponto (`.`) junta os textos sem colocar espaço automaticamente. Para corrigir, basta adicionar um espaço entre aspas:

```php
echo $nome . " " . $curso;
```

Resultado: `Maria ADS`.