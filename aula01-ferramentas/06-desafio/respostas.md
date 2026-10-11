# Atividade 06: Desafio (opcional, ponto extra)

## Evidências esperadas nesta pasta

| Arquivo | O que contém |
|---|---|
| `prints/webhook-recebido.png` | Tela do webhook.site mostrando a requisição POST recebida |
| `comando.txt` | Comando curl utilizado, com a URL substituída por `URL-DO-WEBHOOK` |

## Perguntas

**6.1** Quais cabeçalhos o webhook.site mostrou? Algum deles você não enviou de propósito? De onde ele veio?

Apareceram `Content-Length`, `X-Turma`, `Content-Type`, `Accept`, `User-Agent` e `Host`. Alguns, como `User-Agent: curl/8.21.0` e `Host`, foram adicionados automaticamente pelo curl.

**6.2** Se qualquer pessoa pode montar uma requisição assim, o que isso significa para quem programa o servidor?

Significa que o servidor não pode confiar em qualquer requisição. Ele precisa validar os dados, verificar as permissões e proteger o sistema contra acessos indevidos.