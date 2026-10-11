# Questão 01: O primeiro script e o log do servidor

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `ola.php` | Código fornecido (não altere) |

## 1. Análise do código

**1.1 O arquivo mistura HTML e PHP. Indique quais linhas são HTML e quais são PHP.**

As partes com `<html>`, `<head>`, `<body>`, `<h1>` e `<p>` são HTML. As partes com `<?php ... ?>` e `<?= ... ?>` são PHP. O PHP é usado para gerar os textos e mostrar a hora do servidor.

**1.2 Qual a diferença entre `<?php echo ... ?>` e `<?= ... ?>`?**

Não tem diferença no resultado. Os dois mostram informações na página, mas `<?= ... ?>` é uma forma mais curta de usar `echo`.

## 2. Saídas do terminal

**2.1 Log do servidor**

```text
[Sun Oct 11 19:32:42 2026] PHP 8.5.11 Development Server (http://localhost:8000) started
[Sun Oct 11 19:33:25 2026] [::1]:63267 Accepted
[Sun Oct 11 19:33:25 2026] [::1]:52714 Accepted
[Sun Oct 11 19:33:25 2026] [::1]:63267 [404]: GET / - No such file or directory
[Sun Oct 11 19:33:25 2026] [::1]:63267 Closing
[Sun Oct 11 19:33:26 2026] [::1]:52714 [404]: GET /favicon.ico - No such file or directory
[Sun Oct 11 19:33:26 2026] [::1]:52714 Closing
[Sun Oct 11 19:33:44 2026] [::1]:60560 Accepted
[Sun Oct 11 19:33:44 2026] [::1]:60560 [200]: GET /q01-primeiro-script/ola.php
[Sun Oct 11 19:33:44 2026] [::1]:60560 Closing
[Sun Oct 11 19:34:00 2026] [::1]:56665 Accepted
[Sun Oct 11 19:34:00 2026] [::1]:56437 Accepted
[Sun Oct 11 19:34:00 2026] [::1]:56665 [200]: GET /q01-primeiro-script/ola.php
[Sun Oct 11 19:34:00 2026] [::1]:56665 Closing
[Sun Oct 11 19:34:00 2026] [::1]:53423 Accepted
[Sun Oct 11 19:34:00 2026] [::1]:56437 [200]: GET /q01-primeiro-script/ola.php
[Sun Oct 11 19:34:00 2026] [::1]:56437 Closing
[Sun Oct 11 19:34:01 2026] [::1]:53423 [200]: GET /q01-primeiro-script/ola.php
[Sun Oct 11 19:34:01 2026] [::1]:53423 Closing
[Sun Oct 11 19:34:01 2026] [::1]:57631 Accepted
[Sun Oct 11 19:34:02 2026] [::1]:58649 Accepted
[Sun Oct 11 19:34:02 2026] [::1]:57631 [200]: GET /q01-primeiro-script/ola.php
[Sun Oct 11 19:34:02 2026] [::1]:57631 Closing
[Sun Oct 11 19:34:02 2026] [::1]:52805 Accepted
[Sun Oct 11 19:34:02 2026] [::1]:58649 [200]: GET /q01-primeiro-script/ola.php
[Sun Oct 11 19:34:02 2026] [::1]:58649 Closing
```

**Explicação linha por linha:**

- `Development Server started`: o servidor PHP iniciou na porta 8000.
- `Accepted`: o servidor recebeu uma conexão.
- `[404]: GET /`: a página inicial não foi encontrada.
- `Closing`: a conexão foi encerrada.
- `[404]: GET /favicon.ico`: o navegador procurou o ícone do site, mas não encontrou.
- `Closing`: encerrou essa conexão.
- `Accepted`: recebeu uma nova conexão.
- `[200]: GET /q01-primeiro-script/ola.php`: o arquivo foi encontrado e a página funcionou.
- `Closing`: encerrou a conexão.

As demais linhas repetem `Accepted`, `200 OK` e `Closing`, mostrando novas conexões, acessos bem-sucedidos e encerramentos. Isso aconteceu porque a página foi atualizada várias vezes.

**2.2 Saída de `curl.exe -i http://localhost:8000/q01-primeiro-script/ola.php`**

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Sun, 11 Oct 2026 22:35:43 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Content-type: text/html; charset=UTF-8

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Questão 01</title>
</head>
<body>
  <h1>Olá, turma!</h1>
  <p>Este texto foi escrito pelo PHP.</p>
  <p>Hora no servidor: 22:35:43</p>
</body>
</html>
```

**Explicação linha por linha:**

- `HTTP/1.1 200 OK`: a requisição funcionou.
- `Host`: endereço do servidor.
- `Date`: data e hora da resposta.
- `Connection: close`: a conexão foi encerrada.
- `X-Powered-By`: informa a versão do PHP.
- `Content-type`: informa que a resposta é HTML.
- `<!DOCTYPE html>`: identifica o documento HTML.
- `<html lang="pt-BR">`: define o idioma.
- `<head>`: começa o cabeçalho da página.
- `<meta charset="UTF-8">`: define a codificação.
- `<title>`: título da página.
- `</head>`: encerra o cabeçalho.
- `<body>`: começa o conteúdo.
- `<h1>`: mostra "Olá, turma!".
- Primeiro `<p>`: mostra o texto gerado pelo PHP.
- Segundo `<p>`: mostra a hora do servidor.
- `</body>`: encerra o conteúdo.
- `</html>`: encerra o documento.

## 3. Perguntas

**3.1 Aperte F5 três vezes. O que muda na página e no log? Por quê?**

A hora da página pode mudar e aparecem novas requisições GET no log, porque o navegador solicita a página novamente ao servidor.

**3.2 No "Exibir código-fonte" (Ctrl+U), aparece alguma linha de PHP? Explique.**

Não. O PHP é executado no servidor, então o navegador recebe apenas o HTML pronto.

**3.3 Na saída do curl, o que indicam a primeira linha, o cabeçalho `Content-type` e o cabeçalho `X-Powered-By`?**

A primeira linha mostra que a requisição funcionou (`200 OK`). O `Content-type` indica que o conteúdo é HTML, e o `X-Powered-By` informa que o servidor utiliza PHP 8.5.11.