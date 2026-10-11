# Atividade 04: GET e POST

## Evidências esperadas nesta pasta

| Arquivo | Como gerar |
|---|---|
| `get.txt` | Curl com GET e query string |
| `post-form.txt` | Curl com POST de formulário |
| `post-json.txt` | Curl com POST em JSON usando `corpo.json` |
| `prints/payload-get.png` | Aba Payload do DevTools mostrando Query String Parameters |
| `prints/payload-post.png` | Aba Payload do DevTools mostrando Form Data |

> **Privacidade:** antes do commit, troque o valor do campo `"origin"` nos três arquivos `.txt` por `"(removido)"`, pois ele contém o IP público da conexão.

## Tabela comparativa

| Observação | GET | POST |
|---|---|---|
| Onde os dados apareceram na resposta do httpbin (`args` ou `form`)? | `args` | `form` |
| Os dados apareceram na barra de endereços? | Sim, na URL | Não |
| Qual seção mostrou os dados? | Query String Parameters | Form Data |
| A requisição tinha `Content-Type`? Qual? | Não, normalmente não envia corpo | Sim, `application/x-www-form-urlencoded` |
| O que aconteceu ao apertar F5 na página de resposta? | A página foi atualizada, repetindo o GET | O navegador pode pedir confirmação para reenviar os dados |

## Perguntas

**4.1** No `post-json.txt`, em qual campo da resposta os dados apareceram: `form` ou `json`? Por que foi diferente do `post-form.txt`?

Os dados apareceram em `json`, porque foram enviados no formato JSON. No `post-form.txt`, apareceram em `form`, porque foram enviados como formulário.

**4.2** Dê um exemplo de situação real em que você usaria GET e outro em que usaria POST. Justifique.

Usaria GET para pesquisar produtos em uma loja virtual, pois os dados ficam na URL. Usaria POST para cadastrar um usuário, pois os dados são enviados no corpo da requisição.

**4.3** "Como o POST não mostra os dados na URL, ele é seguro para enviar senhas mesmo sem HTTPS." Essa frase está certa? Explique.

Não. Mesmo que os dados não apareçam na URL, sem HTTPS eles podem ser interceptados durante o envio. O HTTPS protege os dados usando criptografia.