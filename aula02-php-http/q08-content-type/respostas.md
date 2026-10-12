# Questão 08: O que o navegador entende? (Content-Type)

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `dados.php` | Código fornecido. No item 2.2 você vai descomentar a linha do header |
| `prints/devtools-html.png` | DevTools com o Content-Type antes de descomentar |
| `prints/devtools-json.png` | DevTools com o Content-Type depois de descomentar |

## 1. Análise do código

**1.1 Explique o que fazem `json_encode`, `JSON_PRETTY_PRINT` e `JSON_UNESCAPED_UNICODE`.**

- `json_encode()` transforma os dados do PHP em JSON.
- `JSON_PRETTY_PRINT` organiza o JSON com espaços e quebras de linha.
- `JSON_UNESCAPED_UNICODE` mantém os acentos aparecendo normalmente.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -i http://localhost:8000/q08-content-type/dados.php` com o header comentado**

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 00:58:11 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Content-type: text/html; charset=UTF-8

{
    "disciplina": "Programação Web I",
    "status": "Ativo",
    "alunos": 30
}
```

**Explicação linha por linha:**

- `HTTP/1.1 200 OK`: a requisição funcionou.
- `Host`: mostra o endereço do servidor.
- `Date`: mostra a data e a hora da resposta.
- `Connection: close`: indica que a conexão será encerrada.
- `X-Powered-By`: mostra a versão do PHP.
- `Content-type`: informa que o conteúdo é HTML.
- Linha vazia: separa os cabeçalhos do conteúdo.
- `{` e `}`: mostram onde o JSON começa e termina.
- `"disciplina"`: mostra o nome da disciplina.
- `"status"`: mostra a situação da disciplina.
- `"alunos"`: mostra a quantidade de alunos.

**2.2 Saída do mesmo comando com o header descomentado**

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Mon, 12 Oct 2026 01:05:36 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Content-Type: application/json; charset=utf-8

{
    "disciplina": "Programação Web I",
    "status": "Ativo",
    "alunos": 30
}
```

**Explicação linha por linha:**

- `HTTP/1.1 200 OK`: a requisição funcionou.
- `Host`: mostra o endereço do servidor.
- `Date`: mostra a data e a hora da resposta.
- `Connection: close`: indica que a conexão será encerrada.
- `X-Powered-By`: mostra a versão do PHP.
- `Content-Type`: agora informa que o conteúdo é JSON.
- Linha vazia: separa os cabeçalhos do conteúdo.
- `{` e `}`: mostram onde o JSON começa e termina.
- `"disciplina"`: mostra o nome da disciplina.
- `"status"`: mostra a situação da disciplina.
- `"alunos"`: mostra a quantidade de alunos.

## 3. Perguntas

**3.1 Compare o cabeçalho `Content-Type` nas duas saídas. O que mudou?**

Antes aparecia `text/html`, indicando HTML. Depois apareceu `application/json`, indicando JSON.

**3.2 O corpo da resposta mudou? O que isso mostra sobre quem decide como o conteúdo é interpretado?**

Não, o conteúdo continuou igual. Isso mostra que o `Content-Type` informa ao navegador como ele deve interpretar a resposta.

**3.3 Retire o `JSON_UNESCAPED_UNICODE`, rode o curl de novo e explique o que aconteceu com "Programação".**

A palavra apareceu como `Programa\u00e7\u00e3o`. Isso aconteceu porque, sem `JSON_UNESCAPED_UNICODE`, o PHP representa os acentos usando códigos Unicode. O JSON continua funcionando normalmente.