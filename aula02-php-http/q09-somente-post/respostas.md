# Questão 09: Método HTTP e código de status

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `api.php` | Criado por você, conforme o enunciado |

## 1. Análise do código

**1.1 Cole o código do `api.php` e explique cada parte: a verificação do método, o status, os cabeçalhos e o JSON.**

```php
<?php

header("Content-Type: application/json; charset=utf-8");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    header("Allow: POST");

    echo json_encode(
        ["erro" => "Método não permitido"],
        JSON_UNESCAPED_UNICODE
    );

    exit;
}

http_response_code(200);

echo json_encode(
    ["mensagem" => "Requisição POST recebida com sucesso"],
    JSON_UNESCAPED_UNICODE
);
```

**Explicação:**

- `header()` informa que a resposta será em JSON.
- `$_SERVER["REQUEST_METHOD"]` verifica o método usado.
- `!== "POST"` verifica se o método é diferente de POST.
- `http_response_code(405)` informa que o método não é permitido.
- `Allow: POST` informa que somente POST é aceito.
- `json_encode()` transforma as mensagens em JSON.
- `JSON_UNESCAPED_UNICODE` mantém os acentos normalmente.
- `exit` encerra o código quando o método não é permitido.
- `http_response_code(200)` indica que o POST funcionou.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -i http://localhost:8000/q09-somente-post/api.php`**

```text
HTTP/1.1 405 Method Not Allowed
Host: localhost:8000
Date: Mon, 12 Oct 2026 01:19:36 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Content-Type: application/json; charset=utf-8
Allow: POST

{"erro":"Método não permitido"}
```

**Explicação linha por linha:**

- `405 Method Not Allowed`: o método GET não é permitido.
- `Host`: endereço do servidor.
- `Date`: data e hora da resposta.
- `Connection: close`: a conexão será encerrada.
- `X-Powered-By`: versão do PHP.
- `Content-Type`: informa que a resposta é JSON.
- `Allow: POST`: informa que a API aceita POST.
- Linha vazia: separa os cabeçalhos do conteúdo.
- `{"erro":"Método não permitido"}`: mensagem de erro enviada em JSON.

**2.2 Saída de `curl.exe -i -X POST http://localhost:8000/q09-somente-post/api.php`**

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 01:19:42 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Content-Type: application/json; charset=utf-8

{"mensagem":"Requisição POST recebida com sucesso"}
```

**Explicação linha por linha:**

- `200 OK`: a requisição funcionou.
- `Host`: endereço do servidor.
- `Date`: data e hora da resposta.
- `Connection: close`: a conexão será encerrada.
- `X-Powered-By`: versão do PHP.
- `Content-Type`: informa que a resposta é JSON.
- Linha vazia: separa os cabeçalhos do conteúdo.
- `{"mensagem":"Requisição POST recebida com sucesso"}`: confirma que o POST foi aceito.

**2.3 Saída de `curl.exe -i -X PUT http://localhost:8000/q09-somente-post/api.php`**

```text
HTTP/1.1 405 Method Not Allowed
Host: localhost:8000
Date: Mon, 12 Oct 2026 01:19:48 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Content-Type: application/json; charset=utf-8
Allow: POST

{"erro":"Método não permitido"}
```

**Explicação linha por linha:**

- `405 Method Not Allowed`: o método PUT não é permitido.
- `Host`: endereço do servidor.
- `Date`: data e hora da resposta.
- `Connection: close`: a conexão será encerrada.
- `X-Powered-By`: versão do PHP.
- `Content-Type`: informa que a resposta é JSON.
- `Allow: POST`: informa que somente POST é aceito.
- Linha vazia: separa os cabeçalhos do conteúdo.
- `{"erro":"Método não permitido"}`: mensagem de erro enviada em JSON.

**2.4 Log do servidor das três requisições**

```text
[Sun Oct 11 22:19:36 2026] [::1]:64005 Accepted
[Sun Oct 11 22:19:36 2026] [::1]:64005 [405]: GET /q09-somente-post/api.php
[Sun Oct 11 22:19:36 2026] [::1]:64005 Closing
[Sun Oct 11 22:19:42 2026] [::1]:58954 Accepted
[Sun Oct 11 22:19:42 2026] [::1]:58954 [200]: POST /q09-somente-post/api.php
[Sun Oct 11 22:19:42 2026] [::1]:58954 Closing
[Sun Oct 11 22:19:48 2026] [::1]:55042 Accepted
[Sun Oct 11 22:19:48 2026] [::1]:55042 [405]: PUT /q09-somente-post/api.php
[Sun Oct 11 22:19:48 2026] [::1]:55042 Closing
```

**Explicação linha por linha:**

- `Accepted`: o servidor recebeu a conexão do GET.
- `[405]: GET`: o GET foi recusado.
- `Closing`: a conexão do GET foi encerrada.
- `Accepted`: o servidor recebeu a conexão do POST.
- `[200]: POST`: o POST foi aceito.
- `Closing`: a conexão do POST foi encerrada.
- `Accepted`: o servidor recebeu a conexão do PUT.
- `[405]: PUT`: o PUT foi recusado.
- `Closing`: a conexão do PUT foi encerrada.

## 3. Perguntas

**3.1 Que método o navegador usa ao abrir o endereço? Qual status ele recebe?**

O navegador usa GET ao abrir o endereço normalmente. Como a API aceita somente POST, ele recebe o status `405 Method Not Allowed`.

**3.2 Para que serve o cabeçalho `Allow`?**

Serve para informar quais métodos HTTP são permitidos. Nesse caso, somente POST.

**3.3 No log, onde aparecem o método e o status de cada requisição?**

Aparecem nas linhas das requisições, como `[405]: GET`, `[200]: POST` e `[405]: PUT`.