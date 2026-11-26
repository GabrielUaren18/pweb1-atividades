# Aula 06: Laravel na prática

Nome: Gabriel Uaren

Projeto: `aula06-pratica` (Feira Digital)

> As saídas abaixo mostram status, tipo de conteúdo e trechos relevantes. Cabeçalhos variáveis, como data e cookies, foram omitidos.

## A01: Meu cartão de visita

### Saídas
```text
GET /meu-nome
HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8

Meu nome é Gabriel Uaren e estudo ADS no IFCE

GET /meu-nome/
HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8

Meu nome é Gabriel Uaren e estudo ADS no IFCE

GET /Meu-Nome
HTTP/1.1 404 Not Found
Content-Type: text/html; charset=utf-8

GET /cartao
HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8

<h2>Gabriel Uaren</h2><p>Semestre: 6º semestre</p><ul><li>Programação</li><li>Jogos</li><li>Música</li></ul>
```

### Caminho da requisição
GET `/cartao` -> rota em `routes/web.php` -> closure -> resposta HTML 200.

### Respostas
a) As duas respostas são `text/html; charset=utf-8`. A primeira é texto simples, mas continua sendo enviada como HTML; a segunda contém tags HTML.
b) `/meu-nome/` também é atendida (200 OK), pois o Laravel normaliza a barra final. `/Meu-Nome` retorna 404 porque o caminho da rota diferencia maiúsculas de minúsculas.
c) A requisição passa diretamente da rota para a closure e retorna HTML. Ainda não há controller nem view nesse fluxo.

## A02: Meu perfil em JSON

### Saídas
```text
GET /perfil-json
HTTP/1.1 200 OK
Content-Type: application/json
{"nome":"Gabriel Uaren","semestre":6,"media":8.5,"bolsista":true,"disciplinas":["Programa\u00e7\u00e3o Web I","Banco de Dados","Engenharia de Software"],"endereco":{"cidade":"Boa Viagem","uf":"CE"}}

GET /perfil-criado
HTTP/1.1 201 Created
Content-Type: application/json
{"nome":"Gabriel Uaren","semestre":6,"media":8.5,"bolsista":true,"disciplinas":["Programa\u00e7\u00e3o Web I","Banco de Dados","Engenharia de Software"],"endereco":{"cidade":"Boa Viagem","uf":"CE"}}
```

### Caminho da requisição
GET `/perfil-json` -> rota em `routes/web.php` -> closure -> Laravel converte o array para JSON 200.

### Respostas
a) `/perfil-json` retorna 200 OK; `/perfil-criado` retorna 201 Created. Os dois corpos são JSON.
b) O booleano PHP vira `true` em JSON. O array numerado de disciplinas vira uma lista `[...]`, e o array associativo de endereço vira um objeto `{...}`.
c) Com a configuração padrão do PHP, `json_encode(8.0)` pode produzir `8`. JSON não exige que um número inteiro seja escrito com `.0`; `8` e `8.0` representam o mesmo valor numérico.

## A03: Tabuada e idade

### Saídas
```text
GET /tabuada/7
HTTP/1.1 200 OK
O corpo contém os dez resultados abaixo, separados por <br>:
7 x 1 = 7
7 x 2 = 14
7 x 3 = 21
7 x 4 = 28
7 x 5 = 35
7 x 6 = 42
7 x 7 = 49
7 x 8 = 56
7 x 9 = 63
7 x 10 = 70

GET /tabuada/sete
HTTP/1.1 404 Not Found

GET /idade/2005
HTTP/1.1 200 OK
Quem nasceu em 2005 tem ou vai fazer 21 anos em 2026.

GET /boas-vindas-turma
HTTP/1.1 200 OK
Bem-vinda, turma de ADS!
```

### Caminho da requisição
GET `/tabuada/7` -> rota com restrição `whereNumber` -> closure calcula os dez resultados -> HTML 200.

### Respostas
a) `/tabuada/sete` retorna 404 porque o parâmetro não atende a restrição `whereNumber`; a closure não é chamada.
b) A restrição impede valores que não sejam numéricos de chegarem à rota. Sem ela, texto como `sete` seria aceito como parâmetro, embora não represente um número válido para a tabuada.
c) `{turma?}` indica que o segmento é opcional. O padrão `ADS` na closure garante uma saudação válida quando a URL não informa uma turma. Se removermos o padrão da closure e acessarmos `/boas-vindas-turma` sem segmento, Laravel chama a closure sem o argumento obrigatório `$turma`, e o PHP lança `ArgumentCountError` por argumento obrigatório ausente.

## A04: Status e redirecionamentos

### Saídas
```text
GET /admin
HTTP/1.1 403 Forbidden
Área restrita

GET /em-breve
HTTP/1.1 503 Service Unavailable
Página em construção

GET /loja
HTTP/1.1 302 Found
Location: http://127.0.0.1:8000/feira-do-dia

GET /produtos-antigos
HTTP/1.1 301 Moved Permanently
Location: http://127.0.0.1:8000/produtos
```

### Caminho da requisição
GET `/loja` -> rota em `routes/web.php` -> closure cria redirecionamento -> resposta 302 com `Location`.

Em `routes/web.php`, o destino configurado é `/feira-do-dia`. A rota `/feira` existe separadamente, mas não é o destino atual de `/loja`; a saída acima corresponde ao `curl.exe -i` executado contra o código.

### Respostas
a) `/admin` retorna 403 e `/em-breve` retorna 503. Os códigos aparecem na primeira linha da resposta HTTP.
b) `curl.exe -i` mostra o status e os cabeçalhos; no navegador, eles também aparecem em DevTools > Network, selecionando a requisição.
c) O navegador recebe o 302 de `/loja`, faz uma segunda requisição para `/feira-do-dia` e recebe a página de destino. `curl.exe -i` não segue o redirecionamento sem a opção `-L`.
d) 301 indica redirecionamento permanente, como `/produtos-antigos` para `/produtos`. 302 indica redirecionamento temporário. Neste código, `/loja` redireciona para `/feira-do-dia`; embora o enunciado mencione `/feira`, esse não é o destino configurado atualmente.

## A05: O cardápio da feira

### Saídas
```text
GET /cardapio
HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8

<h2>Cardápio da Feira</h2>
<p>Quantidade de pratos: 4</p>
<li>&lt;b&gt;Panelada&lt;/b&gt; - R$ 12,00</li>
```

No código-fonte HTML (Ctrl+U), o nome aparece escapado como `&lt;b&gt;Panelada&lt;/b&gt;`.

### Caminho da requisição
GET `/cardapio` -> rota -> `CardapioController@index` -> view `cardapio` -> layout `layouts/app.blade.php` e partial `partials/menu.blade.php` -> HTML 200.

### Respostas
a) Caminho completo: `GET /cardapio -> routes/web.php -> CardapioController@index -> view cardapio -> layout layouts/app.blade.php e partial partials/menu.blade.php -> resposta HTML 200`. A rota mapeia o endereço ao controller; o controller prepara e envia os pratos; a view monta o conteúdo; o layout fornece a estrutura compartilhada e inclui o partial de navegação; Laravel retorna o HTML ao navegador.
b) As chaves `{{ }}` escapam o HTML. Por isso `<b>` aparece como texto e não formata a palavra. O escape evita que tags fornecidas como dados sejam interpretadas pelo navegador.
c) O layout fornece a estrutura compartilhada, o partial insere a navegação e a view `cardapio.blade.php` fornece o conteúdo específico da página.

## A06: Menu completo e rotas com nome

### Saídas
```text
GET|HEAD cardapio                    cardapio       CardapioController@index
GET|HEAD contato                     contato        routes/web.php
GET|HEAD inscricao                   inscricao.create InscricaoController@create
POST     inscricao                   inscricao.store InscricaoController@store
GET|HEAD produtos                    produtos.index ProdutoController@index
GET|HEAD quem-somos                  sobre          routes/web.php
```

`php artisan route:list --except-vendor` lista 24 rotas, incluindo as rotas acima e o fallback `{fallbackPlaceholder}`. Se o nome `sobre` for trocado por um nome inexistente no menu, Laravel informa `Route [sobree] not defined.`

### Caminho da requisição
GET `/quem-somos` -> rota nomeada `sobre` -> closure -> view `welcome` com o conteúdo da página -> HTML 200.

### Respostas
a) Rotas que usam closures aparecem associadas a `routes/web.php`; as que usam controllers mostram a classe e o método, como `CardapioController@index`.
b) O helper `route('nome')` gera o endereço a partir do nome da rota. Isso evita espalhar caminhos fixos pelo menu e permite alterar o caminho sem reescrever cada link.
c) O erro ocorre quando a view tenta gerar a URL de uma rota não registrada. Como o menu é incluído no layout compartilhado, o erro aparece nas páginas que usam esse layout.

## A07: Do closure ao controller

### Saídas
```php
// Antes: lógica e dados estavam dentro da rota.
Route::get('/cardapio', function () {
    $pratos = [...];
    return view('cardapio', ['pratos' => $pratos]);
});

// Depois: a rota delega ao controller.
Route::get('/cardapio', [CardapioController::class, 'index'])->name('cardapio');
```

Antes e depois, GET `/cardapio` retorna 200 e a mesma view. Se o `use App\Http\Controllers\CardapioController;` for removido, a chamada da rota falha porque Laravel tenta resolver a classe global `CardapioController`, que não existe.

### Caminho da requisição
GET `/cardapio` -> rota -> `CardapioController@index` -> view `cardapio` -> HTML 200.

### Respostas
a) O array de pratos fica no controller; `index()` passa seus dados para a view.
b) No fluxo MVC, a rota direciona a requisição ao controller, e o controller prepara os dados para a view.
c) O `use App\Http\Controllers\CardapioController;` importa a classe do namespace `App\Http\Controllers`. Sem esse `use`, `routes/web.php` não está nesse namespace e o PHP resolve o nome curto `CardapioController` no namespace global (raiz); a classe não é encontrada ali, e Laravel falha ao resolver a rota quando ela é chamada.
d) O controller mantém a lógica fora do arquivo de rotas e facilita manutenção, leitura e teste.

## A08: Estoque e categorias

### Saídas
```text
GET /produtos/categoria/doces
HTTP/1.1 200 OK
Doce de leite - Esgotado

GET /produtos/categoria/frutas
HTTP/1.1 404 Not Found

GET /produtos/categoria/123
HTTP/1.1 404 Not Found
```

### Caminho da requisição
GET `/produtos/categoria/doces` -> rota com `whereAlpha` -> `ProdutoController@categoria` filtra os dados -> view `produtos.index` -> HTML 200.

### Respostas
a) `frutas` atende a rota, mas não há produtos dessa categoria e o controller retorna 404. `123` não atende `whereAlpha`, então a rota não casa e o fallback retorna 404.
b) `array_filter` preserva as chaves dos elementos; elas continuam sendo os IDs usados para criar os links de detalhe.
c) A listagem e o filtro usam a mesma view `produtos.index`. O controller passa a ela a lista completa ou a lista filtrada com o mesmo nome de variável, `produtos`.

## A09: Um produto em JSON

### Saídas
```text
GET /produtos/2/json
HTTP/1.1 200 OK
Content-Type: application/json
{"id":2,"nome":"Doce de leite","categoria":"doces","estoque":0,"preco":15}

GET /produtos/99/json
HTTP/1.1 404 Not Found
Content-Type: application/json
{"erro":"Produto 99 não encontrado"}

GET /produtos/abc/json
HTTP/1.1 404 Not Found
Content-Type: text/html; charset=utf-8
```

### Caminho da requisição
GET `/produtos/2/json` -> rota com `whereNumber` -> `ProdutoController@showJson` -> resposta JSON 200.

### Respostas
a) Produto existente: 200 com JSON. ID inexistente: 404 com JSON de erro. ID não numérico: a rota não casa e o fallback retorna 404 HTML.
b) JSON fornece uma estrutura previsível que clientes de API conseguem interpretar sem analisar uma página HTML.
c) A view não participa porque `showJson()` cria e retorna diretamente a resposta JSON com o status apropriado.

## A10: Inscrição de produtores

### Saídas
```text
POST /inscricao com campos obrigatórios vazios
HTTP/1.1 302 Found
Location: /inscricao
The nome field is required.
The email field is required.
The produto field is required.
The quantidade field is required.

POST /inscricao com quantidade=0 e telefone=123
The quantidade field must be at least 1.
The telefone field must be 11 digits.

POST válido
HTTP/1.1 302 Found
Location: /inscricao
Inscrição recebida: Maria Silva vai trazer 5 de Mel.

Comando `curl.exe -i -X POST http://127.0.0.1:8000/inscricao`, sem carregar o formulário:
HTTP/1.1 419 unknown status
Content-Type: text/html; charset=utf-8
<title>Page Expired</title>
```

### Caminho da requisição
GET `/inscricao` -> `InscricaoController@create` -> view do formulário. POST `/inscricao` -> `InscricaoController@store` -> validação -> redirecionamento para GET `/inscricao` com mensagens ou sucesso na sessão.

### Respostas
a) O Laravel redireciona de volta após erro de validação, guarda os valores enviados na sessão e `old('campo')` os recoloca nos inputs.
b) `@csrf` adiciona o token oculto ao formulário. Uma requisição POST sem token válido é rejeitada com 419.
c) Depois de um envio válido, `store()` redireciona e a página GET mostra a mensagem de sucesso armazenada na sessão.
d) O padrão POST/Redirect/GET evita que atualizar a página reenvie diretamente o formulário e repita o processamento do POST. O comando `curl.exe` acima faz um POST direto: não carrega primeiro o HTML do formulário, não recebe um cookie de sessão válido e não envia o campo `_token`. A diretiva `@csrf` gera o campo no HTML para o navegador enviar quando o formulário é submetido; ela não acrescenta token automaticamente a um POST independente do curl. Por isso Laravel rejeita essa requisição com status 419 e a página tem título “Page Expired”.
