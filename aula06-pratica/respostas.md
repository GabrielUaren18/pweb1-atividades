# Aula 06: Laravel na pratica

Nome: Gabriel Uaren

## A01: Meu cartao de visita

### Saidas
```text
GET /meu-nome
HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8

Meu nome é Gabriel Uaren e estudo ADS no IFCE

GET /cartao
HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8

<h2>Gabriel Uaren</h2><p>Semestre: 6º semestre</p><ul><li>Programação</li><li>Jogos</li><li>Música</li></ul>
```

### Caminho da requisicao
GET /cartao -> rota (web.php) -> closure -> HTML 200

### Respostas
a) As duas rotas usam `text/html; charset=utf-8`. Isso acontece porque o navegador recebe automaticamente esse Content-Type para texto e HTML não escapado da closure; a presença de tags não muda o tipo.
b) `/meu-nome/` também pode ser atendida pelo Laravel, que normaliza a barra final. `/Meu-Nome` não encontra a rota com esse nome exato; rotas são sensíveis a maiúsculas e minúsculas.
c) GET /cartao -> rota -> closure -> resposta HTML; controller e view ficaram de fora.

## A02: Meu perfil em JSON

### Saidas
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

### Caminho da requisicao
GET /perfil-json -> rota -> closure -> JSON 200

### Respostas
a) A diferença está na primeira linha de status: `/perfil-json` usa 200 OK e `/perfil-criado` usa 201 Created.
b) `true` virou o booleano JSON `true`; o array numerado de disciplinas virou `[...]`; o array associativo endereço virou `{...}`. JSON usa objetos `{}` para pares chave-valor e listas `[]` para arrays numerados.
c) Se a nota fosse `8.0`, o encodamento padrão pode representar `8` no JSON, pois JSON não preserva a indicação de ponto decimal separada do valor numérico.

## A03: Tabuada e idade

### Saidas
```text
GET /tabuada/sete
HTTP/1.1 404 Not Found
Content-Type: text/html; charset=utf-8

Página padrão de erro do Laravel/Fallback

GET /idade/2005
HTTP/1.1 200 OK
Quem nasceu em 2005 tem ou vai fazer 21 anos em 2026.
```

### Caminho da requisicao
GET /tabuada/7 -> rota (whereNumber) -> closure -> HTML 200

### Respostas
a) `/tabuada/sete` retorna 404 por causa da restrição `whereNumber`; a rota não atende e o fallback respondeu.
b) Sem `whereNumber`, o parâmetro aceitaria texto e a closure tentaria converter `"sete"` em número. Com a restrição, entradas inválidas são rejeitadas antes da lógica e recebem 404.
c) `{turma?}` torna o parâmetro opcional. Sem o valor padrão na closure, uma chamada sem parâmetro poderia deixar `$turma` indefinido ou gerar erro, enquanto `ADS` garante uma resposta válida.

## A04: Status e redirecionamentos

### Saidas
```text
GET /admin
HTTP/1.1 403 Forbidden
Content-Type: text/html; charset=utf-8

Área restrita

GET /em-breve
HTTP/1.1 503 Service Unavailable
Content-Type: text/html; charset=utf-8

Página em construção

GET /loja
HTTP/1.1 302 Found
Location: http://127.0.0.1:8000/feira-do-dia

GET /produtos-antigos
HTTP/1.1 301 Moved Permanently
Location: http://127.0.0.1:8000/produtos
```

### Caminho da requisicao
GET /loja -> rota -> closure redirect(/feira-do-dia) -> 302 Location

### Respostas
a) As quatro saídas estão registradas acima; os redirecionamentos possuem `Location`.
b) O status pode ser comprovado pelo DevTools, na aba Network/Resposta ou pelo `curl.exe -i`.
c) O navegador faz uma requisição para `/loja` e outra para o endereço indicado em `Location`. O `curl.exe -i` mostra apenas uma resposta porque não segue redirecionamentos automaticamente.
d) 301 é permanente, por exemplo `/produtos-antigos` virou `/produtos`. 302 é temporária, por exemplo `/loja` pode mudar enquanto a Feira está em manutenção.

## A05: O cardapio da feira

### Saidas
```text
GET /cardapio-do-dia
HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8

<h2>Cardápio da Feira</h2>
<p>Quantidade de pratos: 4</p>
<li>&lt;b&gt;Panelada&lt;/b&gt; - R$ 12,00</li>
```

### Caminho da requisicao
GET /cardapio-do-dia -> rota -> CardapioController@index -> view cardapio -> layout app -> HTML 200

### Respostas
a) O caminho está registrado acima.
b) O nome apareceu como texto com `&lt;b&gt;Panelada&lt;/b&gt;`, não em negrito. O `{{ }}` faz escape de HTML. Isso impede que dados vindos do usuário sejam interpretados como tags e reduz o risco de XSS.
c) O Blade juntou `layouts/app.blade.php`, `partials/menu.blade.php` e `cardapio.blade.php` para formar o HTML final.

## A06: Menu completo e rotas com nome

### Saidas
```text
php artisan route:list --except-vendor
GET|HEAD /                       inicio
GET|HEAD /admin                  routes/web.php
GET|HEAD /boas-vindas-turma/{turma?}
GET|HEAD /cardapio-do-dia        cardapio  CardapioController@index
GET|HEAD /inscricao              inscricao.create
POST      /inscricao             inscricao.store
GET|HEAD /produtos               produtos.index  ProdutoController@index
GET|HEAD /produtos/categoria/{categoria} produtos.categoria
GET|HEAD /produtos/{id}          produtos.show
GET|HEAD /produtos/{id}/json     produtos.show-json
GET|HEAD /quem-somos             sobre
GET|HEAD /{fallbackPlaceholder}  routes/web.php
```

### Caminho da requisicao
GET /quem-somos -> rota nomeada sobre -> closure/view -> HTML 200

### Respostas
a) Fechamentos aparecem como `routes/web.php` ou apenas a função de closure; rotas com controllers mostram `ProdutoController@index`, `CardapioController@index` e `InscricaoController@...`.
b) Os links usam `route('nome-da-rota')`, não URLs escritas diretamente. Quando o endereço muda, Laravel gera a nova URL para o mesmo nome.
c) Trocar `route('sobre')` por `route('sobree')` gera `Route [sobree] not defined`. O menu é incluído no layout de todas as páginas, então a falha aparece em qualquer página que renderiza o partial.

## A07: Do closure ao controller

### Saidas
```text
Antes:
Route::get('/cardapio-do-dia', function () {
    $pratos = [...];
    return view('cardapio', ['pratos' => $pratos]);
})->name('cardapio');

Depois:
Route::get('/cardapio-do-dia', [CardapioController::class, 'index'])->name('cardapio');

GET /cardapio-do-dia antes e depois: HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8
```

### Caminho da requisicao
GET /cardapio-do-dia -> rota -> CardapioController@index -> view cardapio -> layout app -> HTML 200

### Respostas
a) O array saiu do closure em `web.php` e foi para o método privado `pratos()` do `CardapioController`; o método `index()` envia os dados à view.
b) O controller entrou no MVC entre rota e view.
c) Sem `use App\Http\Controllers\CardapioController;`, o PHP não encontra a classe e retorna um erro de classe não encontrada. A linha devolve o namespace necessário.
d) Controller separa dados e lógica da configuração das rotas, facilitando manutenção, teste e reutilização.

## A08: Estoque e categorias

### Saidas
```text
GET /produtos/categoria/frutas
HTTP/1.1 404 Not Found
Content-Type: text/html; charset=utf-8

GET /produtos/categoria/123
HTTP/1.1 404 Not Found
Content-Type: text/html; charset=utf-8

GET /produtos
HTTP/1.1 200 OK
Queijo coalho - Estoque: 12
Doce de leite - Esgotado
Mel silvestre - Estoque: 7
```

### Caminho da requisicao
GET /produtos/categoria/doces -> rota -> ProdutoController@categoria -> view produtos.index -> HTML 200

### Respostas
a) `/frutas` passou pela rota e `abort(404)` foi chamado pelo controller porque o filtro ficou vazio. `/123` não passou pela restrição `whereAlpha` e foi atendido pelo fallback, então as páginas 404 são distintas.
b) `array_filter` conserva as chaves originais dos produtos. Assim o ID continua sendo o índice usado por `route('produtos.show', $id)`.
c) A view é apenas um arquivo de apresentação; tanto `index()` quanto `categoria()` fornecem um array chamado `produtos` a ela. Por isso o Blade mostra a mesma estrutura nas duas situações.

## A09: Um produto em JSON

### Saidas
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

### Caminho da requisicao
GET /produtos/2/json -> rota (whereNumber) -> ProdutoController@showJson -> resposta JSON 200

### Respostas
a) O produto existente usa `application/json` e 200. O produto inexistente usa `application/json` e 404 com objeto de erro. `/abc` não passa por `whereNumber` e recebe o 404 HTML do fallback.
b) Clientes de API conseguem interpretar um corpo JSON; `abort(404)` normalmente gera HTML e dificulta o processamento automático do erro.
c) A view ficou de fora porque `showJson()` chama `response()->json(...)`, retornando diretamente dados e status ao cliente.

## A10: Inscricao de produtores

### Saidas
```text
POST vazio
HTTP/1.1 302 Found
Location: http://127.0.0.1:8000/inscricao

Mensagens esperadas:
O campo nome é obrigatório.
O campo email é obrigatório.
O campo produto é obrigatório.
O campo quantidade é obrigatório.

POST quantidade=0, telefone=123
A quantidade deve ser pelo menos 1.
O telefone deve ter 11 caracteres.

POST sem CSRF
HTTP/1.1 419 Page Expired
Content-Type: text/html; charset=utf-8
```

### Caminho da requisicao
GET /inscricao -> rota create -> InscricaoController@create -> view inscricao -> HTML
POST /inscricao -> rota store -> InscricaoController@store -> validação/redirecionamento -> GET /inscricao -> HTML com mensagem

### Respostas
a) Os dados digitados continuam nos campos porque o Laravel mantém os valores da sessão e a diretiva `{{ old('campo') }}` os mostra novamente após o redirecionamento.
b) O curl recebe 419 sem um token válido de sessão/CSRF. O `@csrf` cria um campo oculto `_token` no formulário e liga a requisição à sessão; o curl precisa enviar cookie e token ou receberá 419.
c) Clique em Enviar gera o POST `/inscricao`; o `store()` valida e redireciona com 302 para `inscricao.create`; o navegador segue para o GET `/inscricao`, que renderiza a página com a mensagem da sessão. São duas requisições HTTP.
d) Redirecionar evita a reexibição direta da resposta do POST. Se `store()` devolvesse a view e o usuário pressionasse F5, o navegador poderia reenviar o POST e registrar uma nova inscrição ou mostrar aviso de reenvio.
