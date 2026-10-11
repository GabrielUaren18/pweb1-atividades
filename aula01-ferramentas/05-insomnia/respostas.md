# Atividade 05: Insomnia

## Evidências esperadas nesta pasta

| Arquivo | O que contém |
|---|---|
| `colecao-insomnia.yaml` (ou `.json`) | Coleção exportada com as 5 requisições |
| `prints/insomnia-get.png` | Requisição GET com a aba Params visível |
| `prints/insomnia-post-json.png` | Requisição POST em JSON com o cabeçalho `X-Turma` visível |
| `prints/insomnia-405.png` | Resposta 405 da requisição 5 |

## Requisições que a coleção deve conter

1. `GET` ViaCEP com o CEP `63870-000`, de Boa Viagem - CE.
2. `GET` `https://httpbin.org/get` com os parâmetros `nome` e `curso` na aba Params.
3. `POST` `https://httpbin.org/post` com corpo Form URL Encoded.
4. `POST` `https://httpbin.org/post` com corpo JSON e cabeçalho `X-Turma: ADS`.
5. `POST` `https://httpbin.org/get` com método errado de propósito.

## Perguntas

**5.1** Na requisição 2, o que aconteceu com a URL quando você preencheu a aba Params?

Os parâmetros foram adicionados à URL, ficando `?nome=Gabriel&curso=ADS`.

**5.2** Nas requisições 3 e 4, em quais campos da resposta os dados apareceram (`form` ou `json`)? Por quê?

Na requisição 3, apareceram em `form`, porque foram enviados como formulário. Na requisição 4, apareceram em `json`, porque foram enviados no formato JSON.

**5.3** Na requisição 4, em qual parte da resposta o cabeçalho `X-Turma` apareceu?

Apareceu no campo `headers`, com o valor `ADS`.

**5.4** Qual status voltou na requisição 5? Troque o método para GET e envie de novo: o que mudou?

Retornou `405 Method Not Allowed`. Quando troquei para GET, retornou `200 OK`, porque o método passou a ser aceito.

**5.5** Compare o `User-Agent` recebido pelo httpbin quando a requisição vem do Insomnia e quando vem do navegador. O servidor consegue saber de onde veio a requisição? Ele pode confiar nisso?

No Insomnia apareceu `insomnia/13.3.1`. No navegador aparece um `User-Agent` diferente, identificando o navegador. O servidor consegue ter uma ideia de onde veio a requisição, mas não pode confiar totalmente, pois esse cabeçalho pode ser alterado.