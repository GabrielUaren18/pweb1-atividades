# Questão 10: Cookies e a ordem da resposta HTTP

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `contador.php` | Parte A: criado por você |
| `login.php` | Parte B: código fornecido com erro (corrija no item 1.2) |
| `dashboard.php` | Parte B: criado por você |
| `prints/cookies-application.png` | DevTools, aba Application > Cookies, mostrando o cookie do contador |

> O arquivo `cookies.txt` criado pelo curl **não** deve ser enviado ao GitHub (ele já está no `.gitignore`).

## 1. Análise do código

**1.1 Parte A: cole o código do `contador.php` e explique como ele lê e grava o cookie.**

```php
<?php

$visitas = isset($_COOKIE["visitas"]) ? (int) $_COOKIE["visitas"] : 0;

$visitas++;

setcookie("visitas", (string) $visitas, time() + 3600, "/q10-cookies/");

echo "Você visitou esta página " . $visitas . " vez(es).";
```

**Explicação:**

- `$_COOKIE["visitas"]` pega o número de visitas guardado.
- `isset()` verifica se o cookie existe.
- Se não existir, o contador começa em zero.
- `$visitas++` aumenta o número em 1.
- `setcookie()` envia o novo valor para o navegador guardar por uma hora.
- `echo` mostra a quantidade de visitas.

## 1.2 Parte B

**1.2 Parte B: cole o `login.php` corrigido e o `dashboard.php`, e explique a correção.**

**login.php corrigido:**

```php
<?php

setcookie("usuario_logado", "true", time() + 3600);

header("Location: dashboard.php");

exit;
```

**dashboard.php:**

```php
<?php

if (isset($_COOKIE["usuario_logado"])) {
    echo "Bem-vindo ao dashboard!";
} else {
    echo "Você não está logado.";
}
```

**Explicação:**

O problema era que o `echo` estava antes do `setcookie()` e do `header()`. Isso fazia o PHP tentar enviar os cabeçalhos depois de já ter enviado conteúdo.

Na correção, tirei o `echo` do início e coloquei o cookie e o redirecionamento antes de qualquer saída. Também criei o `dashboard.php` para verificar o cookie de login.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Parte A: saída de `curl.exe -i http://localhost:8000/q10-cookies/contador.php`**

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 01:31:23 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Set-Cookie: visitas=1; expires=Mon, 12 Oct 2026 02:31:23 GMT; Max-Age=3600; path=/q10-cookies/
Content-type: text/html; charset=UTF-8

Você visitou esta página 1 vez(es).
```

**Explicação linha por linha:**

- `200 OK`: a requisição funcionou.
- `Host`: endereço do servidor.
- `Date`: data e hora da resposta.
- `Connection: close`: a conexão será encerrada.
- `X-Powered-By`: versão do PHP.
- `Set-Cookie`: pede para guardar o cookie `visitas` com valor 1 por uma hora.
- `Content-type`: informa que a resposta é HTML.
- Linha vazia: separa os cabeçalhos do conteúdo.
- Última linha: mostra que a página foi visitada uma vez.

**2.2 Parte A: saída de `curl.exe -i -c cookies.txt -b cookies.txt http://localhost:8000/q10-cookies/contador.php`, executado três vezes (cole a terceira)**

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 01:32:38 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Set-Cookie: visitas=3; expires=Mon, 12 Oct 2026 02:32:38 GMT; Max-Age=3600; path=/q10-cookies/
Content-type: text/html; charset=UTF-8

Você visitou esta página 3 vez(es).
```

**Explicação linha por linha:**

- `200 OK`: a requisição funcionou.
- `Host`: endereço do servidor.
- `Date`: data e hora da resposta.
- `Connection: close`: a conexão será encerrada.
- `X-Powered-By`: versão do PHP.
- `Set-Cookie`: atualiza o cookie para 3 visitas.
- `Content-type`: informa que a resposta é HTML.
- Linha vazia: separa os cabeçalhos do conteúdo.
- Última linha: mostra 3 visitas porque o `curl` reutilizou o cookie.

**2.3 Parte B, antes da correção: saída de `curl.exe -i http://localhost:8000/q10-cookies/login.php`**

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 01:35:21 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Content-type: text/html; charset=UTF-8

Carregando a página...<br />
<b>Warning</b>:  Cannot modify header information - headers already sent by (output started at C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula02-php-http\q10-cookies\login.php:2) in <b>C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula02-php-http\q10-cookies\login.php</b> on line <b>3</b><br />
<br />
<b>Warning</b>:  Cannot modify header information - headers already sent by (output started at C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula02-php-http\q10-cookies\login.php:2) in <b>C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula02-php-http\q10-cookies\login.php</b> on line <b>4</b><br />
```

**Explicação linha por linha:**

- `200 OK`: o servidor respondeu, mas não conseguiu redirecionar.
- `Host`: endereço do servidor.
- `Date`: data e hora da resposta.
- `Connection: close`: a conexão será encerrada.
- `X-Powered-By`: versão do PHP.
- `Content-type`: informa que a resposta é HTML.
- Linha vazia: separa os cabeçalhos do conteúdo.
- `Carregando a página...`: texto mostrado pelo `echo`.
- Primeiro `Warning`: o `setcookie()` falhou na linha 3 porque o `echo` já tinha enviado conteúdo na linha 2.
- Linha `<br />`: quebra de linha do HTML.
- Segundo `Warning`: o `header()` falhou na linha 4 pelo mesmo motivo.

## 2.4 Parte B, depois da correção

**2.4 Parte B, depois da correção: saída de `curl.exe -i http://localhost:8000/q10-cookies/login.php`**

```text
HTTP/1.1 302 Found
Host: localhost:8000
Date: Mon, 12 Oct 2026 01:36:33 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Set-Cookie: usuario_logado=true; expires=Mon, 12 Oct 2026 02:36:33 GMT; Max-Age=3600
Location: dashboard.php
Content-type: text/html; charset=UTF-8
```

**Explicação linha por linha:**

- `302 Found`: o servidor pediu um redirecionamento.
- `Host`: endereço do servidor.
- `Date`: data e hora da resposta.
- `Connection: close`: a conexão será encerrada.
- `X-Powered-By`: versão do PHP.
- `Set-Cookie`: envia o cookie `usuario_logado=true`, válido por uma hora.
- `Location: dashboard.php`: informa para onde o navegador deve ir.
- `Content-type`: informa que a resposta é HTML.

## 3. Perguntas

**3.1 No item 2.1, qual cabeçalho da resposta grava o cookie? E por que o contador não passa de 1 se você repetir o comando sem `-c` e `-b`?**

É o `Set-Cookie`. Sem `-c` e `-b`, o `curl` não guarda nem reutiliza o cookie entre os comandos. Por isso, o contador sempre começa em 1.

**3.2 No item 2.2, o que fazem as opções `-c` e `-b`? O que isso prova sobre quem "lembra" do usuário no HTTP?**

O `-c` salva os cookies no arquivo e o `-b` lê os cookies guardados. Isso mostra que quem lembra das visitas é o cliente, como o navegador ou o `curl`, ao guardar e enviar o cookie novamente.

**3.3 No item 2.3, qual aviso apareceu e por que o redirecionamento não aconteceu?**

Apareceu `Cannot modify header information - headers already sent`. Isso aconteceu porque o `echo` enviou conteúdo antes do `header()`, impedindo o redirecionamento.

**3.4 No item 2.4, explique o status, o cabeçalho `Location` e o cabeçalho `Set-Cookie`. Por que `setcookie()` e `header()` precisam vir antes de qualquer `echo`?**

O `302 Found` indica o redirecionamento. O `Location` informa a página de destino e o `Set-Cookie` envia o cookie de login.

O `setcookie()` e o `header()` precisam vir antes do `echo` porque os cabeçalhos HTTP devem ser enviados antes do conteúdo da página.