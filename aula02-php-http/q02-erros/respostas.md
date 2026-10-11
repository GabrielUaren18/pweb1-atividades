# Questão 02: Lendo mensagens de erro

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `erro.php` | Código fornecido com um erro proposital (corrigido no item 3.3) |

## 1. Análise do código

**1.1 Antes de executar: qual é o erro do código? Em que linha ele está?**

O erro está na linha 2, porque faltou um ponto e vírgula (`;`) depois de `"ADS"`.

## 2. Saídas do terminal

**2.1 Log do servidor ao abrir a página com `display_errors=1`**

```text
[Sun Oct 11 19:43:53 2026] [::1]:54908 [200]: GET /q02-erros/erro.php - syntax error, unexpected token "echo" in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula02-php-http\q02-erros\erro.php on line 3
[Sun Oct 11 19:43:53 2026] [::1]:54908 Closing
```

**Explicação linha por linha:**

- Primeira linha: o servidor recebeu uma requisição GET e mostrou um erro de sintaxe na linha 3. Mesmo com erro, retornou status `200`.
- Segunda linha: a conexão foi encerrada.

**2.2 Log do servidor ao abrir a página com `display_errors=0`**

```text
[Sun Oct 11 19:45:42 2026] [::1]:58846 Accepted
[Sun Oct 11 19:45:42 2026] [::1]:59974 [500]: GET /q02-erros/erro.php - syntax error, unexpected token "echo" in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula02-php-http\q02-erros\erro.php on line 3
[Sun Oct 11 19:45:42 2026] [::1]:59974 Closing
```

**Explicação linha por linha:**

- Primeira linha: o servidor recebeu uma conexão.
- Segunda linha: o PHP encontrou um erro de sintaxe na linha 3 e retornou status `500`.
- Terceira linha: a conexão foi encerrada.

## 3. Perguntas

**3.1 A mensagem diz que o erro está em qual linha? Por que não é a linha onde falta o `;`?**

A mensagem aponta a linha 3, porque foi onde o PHP encontrou o `echo` inesperado. Mas o erro verdadeiro está na linha 2, onde faltou o `;`.

**3.2 Compare o status registrado no log nas duas execuções (`[200]` e `[500]`). Por que eles são diferentes? Qual dos dois é o correto do ponto de vista do HTTP?**

Com `display_errors=1`, apareceu `200`, porque o PHP exibiu o erro na resposta. Com `display_errors=0`, apareceu `500`, indicando uma falha no servidor. O correto é `500`, porque o código não conseguiu executar normalmente.

**3.3 Corrija o código, faça um commit e cole aqui o log da execução corrigida.**

Corrigi o código colocando o `;` que faltava na linha 2. Depois disso, a página funcionou normalmente.

Código corrigido:

```php
<?php
$curso = "ADS";
echo "Bem-vindo ao curso de $curso";
```

Log da execução corrigida:

```text
[Sun Oct 11 19:46:29 2026] PHP 8.5.11 Development Server (http://localhost:8000) started
[Sun Oct 11 19:46:44 2026] [::1]:60708 Accepted
[Sun Oct 11 19:46:44 2026] [::1]:50732 Accepted
[Sun Oct 11 19:46:44 2026] [::1]:60708 [200]: GET /q02-erros/erro.php
[Sun Oct 11 19:46:44 2026] [::1]:60708 Closing
```

**Explicação:** O servidor iniciou, recebeu as conexões e executou o arquivo normalmente, retornando status `200`.