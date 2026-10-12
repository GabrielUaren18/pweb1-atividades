# Questão 07 — O dado pode não vir, o dado pode ser perigoso

## 1. Análise do código

### 1.1 Quais são os dois problemas deste código?

O primeiro problema é que, se ninguém informar o nome na URL, o PHP mostra um aviso porque a informação não existe.

O segundo é que o código aceita HTML e JavaScript sem proteção, permitindo ataques XSS.

### 1.2 Código corrigido

```php
<?php

$nome = $_GET['nome'] ?? "Visitante";

$nome = htmlspecialchars($nome, ENT_QUOTES, "UTF-8");

echo "Olá, " . $nome;
```

O `??` coloca "Visitante" quando o nome não é informado. Já o `htmlspecialchars()` transforma os caracteres especiais em texto, impedindo que o navegador interprete HTML ou JavaScript.

## 2. Saídas do terminal

### 2.1 Antes da correção: log sem parâmetro

```text
[Sun Oct 11 21:44:00 2026] [::1]:50215 Accepted
[Sun Oct 11 21:44:00 2026] PHP Warning:  Undefined array key "nome" in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula02-php-http\q07-tratamento\saudacao.php on line 2
[Sun Oct 11 21:44:00 2026] [::1]:50215 [200]: GET /q07-tratamento/saudacao.php
[Sun Oct 11 21:44:00 2026] [::1]:50215 Closing
```

**Explicação linha por linha:**

- `Accepted`: o servidor recebeu a conexão.
- `PHP Warning`: o PHP avisou que o nome não foi informado.
- `200 GET`: o servidor recebeu a requisição e respondeu com status 200.
- `Closing`: a conexão foi encerrada.

### 2.2 Antes da correção: enviando HTML

```text
Olá, <b>Oi</b>
```

**Explicação linha por linha:**

O PHP mostrou "Olá," e devolveu `<b>Oi</b>` sem proteção. No navegador, essa tag deixa o texto em negrito.

### 2.3 Depois da correção: enviando HTML

```text
Olá, &lt;b&gt;Oi&lt;/b&gt;
```

**Explicação linha por linha:**

O PHP mostrou "Olá," e transformou os sinais `<` e `>` em caracteres especiais. Assim, o navegador mostra `<b>Oi</b>` como texto, sem deixar a palavra em negrito.

## 3. Perguntas

### 3.1 Qual aviso apareceu no item 2.1? O que significa?

Apareceu `Undefined array key "nome"`. Isso significa que o PHP tentou acessar um nome que não foi informado na URL.

### 3.2 O que o htmlspecialchars fez com `<b>`?

Antes, o PHP devolvia `<b>` normalmente. Depois, o `htmlspecialchars()` transformou `<` em `&lt;` e `>` em `&gt;`, fazendo a tag aparecer como texto.

### 3.3 Teste de XSS

Antes da correção, apareceu uma janela com a mensagem "Ataque", porque o navegador executou o JavaScript enviado pela URL.

Depois da correção, o código JavaScript passa a ser mostrado como texto e a janela não deve aparecer.

Isso é perigoso porque alguém pode tentar executar códigos maliciosos no navegador de outra pessoa. Esse ataque é chamado de XSS.