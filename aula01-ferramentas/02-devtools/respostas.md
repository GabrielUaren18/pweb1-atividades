# Atividade 02: DevTools, a anatomia de uma página

## Evidências esperadas nesta pasta

| Arquivo | Conteúdo |
|---|---|
| `prints/01-network-geral.png` | Aba Network após carregar o site do IFCE, mostrando o total de requisições |
| `prints/02-redirecionamento.png` | Headers da requisição que respondeu com 301 |
| `prints/03-timing.png` | Aba Timing da requisição Doc da página final |

> Antes de salvar os prints, confira se nenhum cookie aparece na imagem. Se aparecer, recorte a imagem.

## Tabela de observações

| Item | Seu resultado |
|---|---|
| Total de requisições | A preencher pela aba Network |
| Total transferido | A preencher pela aba Network |
| Quantas requisições aparecem no filtro Doc | A preencher pelo filtro Doc |
| Status da requisição para `https://ifce.edu.br/` | 301 Moved Permanently |
| Valor do cabeçalho `Location` | `https://portal.ifce.edu.br/` |
| Remote Address (IP e porta) | `200.129.17.217:443` |
| Protocolo (h2 ou http/1.1) | A confirmar na aba Network |
| Tempo de DNS Lookup (aba Timing) | Não informado no resultado enviado |
| Tempo de Waiting for server response | A confirmar na aba Timing |

## Perguntas

**2.1** Por que uma única página gera tantas requisições? Cite três tipos de arquivo diferentes que você encontrou.

Uma página gera várias requisições porque precisa carregar diferentes arquivos e recursos. Três exemplos são HTML, CSS e JavaScript.

**2.2** O IP do Remote Address é o mesmo que você encontrou na Atividade 01? O que significa o número depois dos dois-pontos?

Sim, o IP `200.129.17.217` é o mesmo encontrado na Atividade 01. O número `443` representa a porta utilizada na conexão HTTPS.

**2.3** Explique, com suas palavras, o que o navegador fez ao receber o status 301.

O navegador recebeu o status `301 Moved Permanently`, que indica um redirecionamento permanente, e foi direcionado para `https://portal.ifce.edu.br/`, informado no cabeçalho `Location`.

**2.4** Ao digitar `http://ifce.edu.br` (sem o "s"), o DevTools mostrou a requisição em HTTP? Explique o que aconteceu.

É necessário conferir o resultado dessa requisição no DevTools. Se o navegador recebeu um redirecionamento, ele foi direcionado para outro endereço, possivelmente a versão HTTPS do site.
