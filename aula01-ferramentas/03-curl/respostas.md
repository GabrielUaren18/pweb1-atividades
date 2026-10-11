# Atividade 03: curl

## Evidências esperadas nesta pasta

| Arquivo | O que contém |
|---|---|
| `cep.json` | Resposta do ViaCEP para o CEP da sua cidade |
| `cabecalhos.txt` | Cabeçalhos da consulta com `-I` |
| `redirecionamentos.txt` | Redirecionamentos de `http://ifce.edu.br` com `-IL` |
| `status.txt` | Códigos de status HTTP gerados pelo httpbin |

## Parte A: JSON pelo HTTP

**3.1** Qual CEP você consultou e qual cidade o ViaCEP retornou?

Consultei o CEP `63870-000`, e o ViaCEP retornou Boa Viagem, Ceará.

**3.2** Qual o valor do cabeçalho `Content-Type` em `cabecalhos.txt`? O que ele informa ao cliente?

O valor foi `text/plain; charset=utf-8`. Ele informa o tipo de conteúdo retornado e a codificação dos caracteres. Como usei `curl -I`, o servidor respondeu à requisição HEAD, sem enviar o corpo da resposta.

**3.3** O que significa o cabeçalho `Cache-Control: max-age=3600`?

Significa que a resposta pode ficar armazenada em cache por até 3600 segundos, ou seja, uma hora.

**3.4** Consulte um CEP inexistente (`00000000`) e um com letras (`abc`). Qual status e qual conteúdo voltaram em cada caso?

- CEP `00000000`: status `200 OK`, com um JSON indicando `"erro": "true"`.
- CEP `abc`: status `400 Bad Request`, com uma página HTML informando que a URL é inválida.

## Parte B: redirecionamentos

**3.5** Quantas respostas aparecem em `redirecionamentos.txt`? Liste o status e o `location` de cada uma.

Apareceram três respostas:

1. `301 Moved Permanently` — `https://ifce.edu.br/`
2. `301 Moved Permanently` — `https://portal.ifce.edu.br/`
3. `200 OK` — resposta final, sem cabeçalho `Location`.

**3.6** Qual o valor do cabeçalho `server` na última resposta? Pesquise o que é esse software e responda: o portal do IFCE é feito em PHP?

O valor do cabeçalho `server` foi `gunicorn`. O Gunicorn é um servidor HTTP usado para executar aplicações web Python. O novo portal do IFCE utiliza o sistema Wagtail, baseado em Django, que utiliza Python. Portanto, as informações indicam que o portal não é feito em PHP. 

**3.7** No DevTools, ao digitar `http://ifce.edu.br` (sem o "s"), o primeiro redirecionamento aparece? Por que o curl mostra algo que o navegador escondeu?

No DevTools, o primeiro redirecionamento pode não aparecer porque o navegador pode usar informações em cache ou atualizar a conexão para HTTPS automaticamente. Já o `curl.exe -IL` mostra os cabeçalhos de cada resposta da cadeia de redirecionamentos.

## Parte C: códigos de status

**3.8** Complete a tabela com os códigos de `status.txt`:

| Endereço | Status obtido | Família | Significado |
|---|---:|---|---|
| `/status/200` | 200 | 2xx | Requisição realizada com sucesso |
| `/status/201` | 201 | 2xx | Recurso criado com sucesso |
| `/status/302` | 302 | 3xx | Redirecionamento temporário |
| `/status/404` | 404 | 4xx | Recurso não encontrado |
| `/status/405` | 405 | 4xx | Método HTTP não permitido |
| `/status/500` | 500 | 5xx | Erro interno do servidor |

**3.9** Qual a diferença entre um erro 404 e um erro 500? De quem é a "culpa" em cada caso?

O erro 404 significa que o recurso solicitado não foi encontrado. O erro 500 significa que ocorreu uma falha interna no servidor. O 404 geralmente está relacionado ao endereço solicitado, enquanto o 500 está relacionado a um problema no processamento do servidor.
