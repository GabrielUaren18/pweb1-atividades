# Aula 06: Laravel na prática

Nome: Gabriel Uaren

Projeto: `aula06-pratica` (Feira Digital)

> As saídas abaixo mostram os status, os tipos de conteúdo e os trechos relevantes observados. Cabeçalhos variáveis, como data e cookies, foram omitidos.

## A01: Meu cartão de visita

### Saídas

**`GET /meu-nome`**

```http
HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8

Meu nome é Gabriel Uaren e estudo ADS no IFCE
```

**`GET /meu-nome/`**

```http
HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8

Meu nome é Gabriel Uaren e estudo ADS no IFCE
```

**`GET /Meu-Nome`**

```http
HTTP/1.1 404 Not Found
Content-Type: text/html; charset=utf-8
```

**`GET /cartao`**

```http
HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8

<h2>Gabriel Uaren</h2><p>Semestre: 6º semestre</p><ul><li>Programação</li><li>Jogos</li><li>Música</li></ul>
```

### Caminho da requisição

`GET /cartao` -> rota em `routes/web.php` -> closure -> resposta HTML 200.

### Respostas

a) As duas rotas retornam `text/html; charset=utf-8`. `/meu-nome` contém texto simples, enquanto `/cartao` devolve uma string com tags HTML; ambas são respostas textuais servidas com tipo HTML.

b) `/meu-nome/` também retorna 200 porque o Laravel normaliza a barra final. Já `/Meu-Nome` retorna 404: o caminho da rota diferencia maiúsculas de minúsculas e não corresponde ao caminho registrado.

c) A requisição é atendida diretamente por uma closure definida em `routes/web.php`. Nesse fluxo, não há controller nem view: a closure produz a resposta HTML.

## A02: Meu perfil em JSON

### Saídas

**`GET /perfil-json`**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{"nome":"Gabriel Uaren","semestre":6,"media":8.5,"bolsista":true,"disciplinas":["Programa\u00e7\u00e3o Web I","Banco de Dados","Engenharia de Software"],"endereco":{"cidade":"Boa Viagem","uf":"CE"}}
```

**`GET /perfil-criado`**

```http
HTTP/1.1 201 Created
Content-Type: application/json

{"nome":"Gabriel Uaren","semestre":6,"media":8.5,"bolsista":true,"disciplinas":["Programa\u00e7\u00e3o Web I","Banco de Dados","Engenharia de Software"],"endereco":{"cidade":"Boa Viagem","uf":"CE"}}
```

### Caminho da requisição

`GET /perfil-json` -> rota em `routes/web.php` -> closure devolve um array -> Laravel converte o array para JSON e responde com status 200.

### Respostas

a) `/perfil-json` retorna 200 OK, enquanto `/perfil-criado` retorna 201 Created. As duas respostas têm corpo JSON; o código 201 indica que a resposta representa um recurso criado.

b) Na conversão, o booleano PHP vira `true` em JSON. O array numerado de disciplinas vira uma lista (`[...]`), e o array associativo de endereço vira um objeto (`{...}`), com pares de chave e valor.

c) Com a configuração padrão do PHP, `json_encode(8.0)` pode produzir `8`. JSON não exige que um número inteiro seja escrito com `.0`; `8` e `8.0` têm o mesmo valor numérico, embora a representação textual possa variar.

## A03: Tabuada e idade

### Saídas

**`GET /tabuada/7`**

```http
HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8

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
```

As linhas da tabuada são separadas por `<br>` na resposta HTML.

**`GET /tabuada/sete`**

```http
HTTP/1.1 404 Not Found
Content-Type: text/html; charset=utf-8
```

**`GET /idade/2005`**

```http
HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8

Quem nasceu em 2005 tem ou vai fazer 21 anos em 2026.
```

**`GET /boas-vindas-turma`**

```http
HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8

Bem-vinda, turma de ADS!
```

### Caminho da requisição

`GET /tabuada/7` -> rota com restrição `whereNumber` -> closure calcula os resultados -> resposta HTML 200.

### Respostas

a) `/tabuada/sete` retorna 404 porque o parâmetro não atende à restrição `whereNumber`. Como o caminho não corresponde à rota numérica, a closure da tabuada não é chamada.

b) A restrição `whereNumber` limita o parâmetro da URL a valores numéricos antes da execução da closure. Sem essa restrição, um texto como `sete` poderia ser recebido como parâmetro, mas não seria uma entrada numérica válida para o cálculo.

c) `{turma?}` indica que o segmento é opcional, e o padrão `ADS` na closure fornece o valor usado quando a URL não informa uma turma. Se o padrão for removido e `/boas-vindas-turma` for acessada sem segmento, Laravel chama a closure sem o argumento obrigatório `$turma`; o PHP lança `ArgumentCountError` por argumento obrigatório ausente.

## A04: Status e redirecionamentos

### Saídas

**`GET /admin`**

```http
HTTP/1.1 403 Forbidden
Content-Type: text/html; charset=utf-8

Área restrita
```

**`GET /em-breve`**

```http
HTTP/1.1 503 Service Unavailable
Content-Type: text/html; charset=utf-8

Página em construção
```

**`GET /loja`**

```http
HTTP/1.1 302 Found
Location: http://127.0.0.1:8000/feira-do-dia
```

**`GET /produtos-antigos`**

```http
HTTP/1.1 301 Moved Permanently
Location: http://127.0.0.1:8000/produtos
```

### Caminho da requisição

`GET /loja` -> rota em `routes/web.php` -> closure cria um redirecionamento -> resposta 302 com o cabeçalho `Location`.

Em `routes/web.php`, o destino configurado para `/loja` é `/feira-do-dia`. A rota `/feira` existe separadamente, mas não é o destino atual de `/loja`; o cabeçalho acima corresponde ao `curl.exe -i` executado contra o código.

### Respostas

a) `/admin` retorna 403 Forbidden e `/em-breve` retorna 503 Service Unavailable. Os status aparecem na primeira linha HTTP e indicam, respectivamente, acesso proibido e indisponibilidade temporária.

b) A opção `-i` do `curl.exe` inclui os cabeçalhos na saída, permitindo verificar o status e, nos redirecionamentos, o valor de `Location`. No navegador, os mesmos dados podem ser conferidos em DevTools > Network, selecionando a requisição.

c) O navegador recebe o 302 de `/loja` e faz uma segunda requisição para `/feira-do-dia`, endereço indicado em `Location`. `curl.exe -i` mostra a primeira resposta sem seguir o redirecionamento; para segui-lo, seria necessária a opção `-L`.

d) 301 representa um redirecionamento permanente, como `/produtos-antigos` para `/produtos`; 302 representa um redirecionamento temporário. Neste código, `/loja` aponta para `/feira-do-dia`, embora o enunciado mencione `/feira`.

## A05: O cardápio da feira

### Saídas

**`GET /cardapio`**

```http
HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8

<h2>Cardápio da Feira</h2>
<p>Quantidade de pratos: 4</p>
<li>&lt;b&gt;Panelada&lt;/b&gt; - R$ 12,00</li>
```

No código-fonte HTML (Ctrl+U), o nome aparece escapado como `&lt;b&gt;Panelada&lt;/b&gt;`.

### Caminho da requisição

`GET /cardapio` -> rota -> `CardapioController@index` -> view `cardapio` -> layout `layouts/app.blade.php` e partial `partials/menu.blade.php` -> resposta HTML 200.

### Respostas

a) Caminho completo: `GET /cardapio -> routes/web.php -> CardapioController@index -> view cardapio -> layout layouts/app.blade.php e partial partials/menu.blade.php -> resposta HTML 200`. A rota associa o endereço ao controller; o controller prepara os pratos e os envia à view; a view monta o conteúdo específico do cardápio; o layout fornece a estrutura compartilhada e inclui o partial de navegação; por fim, Laravel devolve o HTML ao navegador.

b) As chaves Blade `{{ }}` escapam os caracteres especiais do valor. Por isso, `<b>` aparece como texto (`&lt;b&gt;`) em vez de formatar “Panelada” em negrito. Esse escape também evita que dados com marcação sejam interpretados como HTML pelo navegador.

c) `layouts/app.blade.php` define a estrutura compartilhada da página; `partials/menu.blade.php` fornece a navegação incluída pelo layout; e `cardapio.blade.php` contém o conteúdo específico desta página. O Blade combina essas partes na resposta final.

## A06: Menu completo e rotas com nome

### Saídas

**Trecho de `php artisan route:list --except-vendor`**

```text
GET|HEAD cardapio                    cardapio       CardapioController@index
GET|HEAD contato                     contato        routes/web.php
GET|HEAD inscricao                   inscricao.create InscricaoController@create
POST     inscricao                   inscricao.store InscricaoController@store
GET|HEAD produtos                    produtos.index ProdutoController@index
GET|HEAD quem-somos                  sobre          routes/web.php
```

O comando lista 24 rotas, incluindo as mostradas acima e o fallback `{fallbackPlaceholder}`. Se o nome `sobre` for trocado no menu por um nome não registrado, Laravel informa `Route [sobree] not defined.`

### Caminho da requisição

`GET /quem-somos` -> rota nomeada `sobre` -> closure -> view `welcome` com o conteúdo da página -> resposta HTML 200.

### Respostas

a) As rotas definidas por closures aparecem associadas a `routes/web.php`; nas rotas que usam controllers, a tabela mostra a classe e o método, por exemplo, `CardapioController@index`.

b) O helper `route('nome')` cria a URL usando o nome registrado para a rota. Assim, os links do menu não precisam repetir caminhos fixos, e uma mudança de caminho pode ser feita sem atualizar cada link que usa o mesmo nome.

c) Se a view pedir uma rota que não está registrada, Laravel não consegue gerar a URL e lança o erro `Route [sobree] not defined.`. Como o menu que contém os links é incluído pelo layout compartilhado, o erro pode surgir em qualquer página que renderize esse layout.

## A07: Do closure ao controller

### Saídas

**Antes: lógica dentro da rota**

```php
Route::get('/cardapio', function () {
    $pratos = [...];
    return view('cardapio', ['pratos' => $pratos]);
});
```

**Depois: rota delega ao controller**

```php
Route::get('/cardapio', [CardapioController::class, 'index'])->name('cardapio');
```

Antes e depois, `GET /cardapio` retorna 200 e a mesma view. Se `use App\Http\Controllers\CardapioController;` for removido, a chamada da rota falha porque o nome curto da classe não é resolvido para o controller.

### Caminho da requisição

`GET /cardapio` -> rota -> `CardapioController@index` -> view `cardapio` -> resposta HTML 200.

### Respostas

a) Os dados dos pratos ficam no controller, no método `pratos()`, e `index()` os envia para a view. Assim, a rota deixa de conter a preparação dos dados e apenas direciona a requisição.

b) No fluxo MVC, a rota recebe e encaminha a requisição ao controller; o controller prepara os dados e escolhe a view; a view transforma esses dados em HTML para a resposta.

c) `use App\Http\Controllers\CardapioController;` importa a classe do namespace `App\Http\Controllers`. Sem essa declaração, `routes/web.php` não está nesse namespace, então o PHP procura o nome curto `CardapioController` no namespace global (raiz); como a classe não está ali, Laravel falha ao resolver a rota quando ela é chamada.

d) O controller separa a lógica de aplicação da configuração das rotas. Isso deixa `web.php` mais simples e torna a lógica mais fácil de localizar, manter e testar.

## A08: Estoque e categorias

### Saídas

**`GET /produtos/categoria/doces`**

```http
HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8

Doce de leite - Esgotado
```

**`GET /produtos/categoria/frutas`**

```http
HTTP/1.1 404 Not Found
Content-Type: text/html; charset=utf-8
```

**`GET /produtos/categoria/123`**

```http
HTTP/1.1 404 Not Found
Content-Type: text/html; charset=utf-8
```

### Caminho da requisição

`GET /produtos/categoria/doces` -> rota com restrição `whereAlpha` -> `ProdutoController@categoria` filtra os produtos -> view `produtos.index` -> resposta HTML 200.

### Respostas

a) `frutas` atende à rota alfabética, mas não há produtos dessa categoria; por isso, o controller chama `abort(404)`. Já `123` não atende a `whereAlpha`, então a rota não casa e o fallback retorna 404.

b) `array_filter` mantém as chaves originais dos itens que passam pelo filtro. Como essas chaves representam os IDs, os links de detalhe continuam apontando para os produtos corretos.

c) A listagem completa e a listagem por categoria usam `produtos.index`. O controller envia a ambas o mesmo tipo de dado, uma lista chamada `produtos`; a diferença é que no segundo caso ela já foi filtrada.

## A09: Um produto em JSON

### Saídas

**`GET /produtos/2/json`**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{"id":2,"nome":"Doce de leite","categoria":"doces","estoque":0,"preco":15}
```

**`GET /produtos/99/json`**

```http
HTTP/1.1 404 Not Found
Content-Type: application/json

{"erro":"Produto 99 não encontrado"}
```

**`GET /produtos/abc/json`**

```http
HTTP/1.1 404 Not Found
Content-Type: text/html; charset=utf-8
```

### Caminho da requisição

`GET /produtos/2/json` -> rota com restrição `whereNumber` -> `ProdutoController@showJson` -> resposta JSON 200.

### Respostas

a) Para o ID existente, o controller devolve 200 e os dados em JSON. Para o ID inexistente, devolve 404 com um objeto JSON de erro. Um ID não numérico não passa por `whereNumber`, então o fallback retorna 404 HTML.

b) Uma API responde com JSON estruturado, que pode ser interpretado diretamente pelo cliente. Uma página HTML de erro exigiria que o cliente analisasse uma estrutura feita para exibição, não para dados.

c) A view não participa: `showJson()` cria e retorna diretamente a resposta JSON, escolhendo o status conforme o produto foi encontrado ou não.

## A10: Inscrição de produtores

### Saídas

**POST `/inscricao` com campos obrigatórios vazios**

```http
HTTP/1.1 302 Found
Location: /inscricao

The nome field is required.
The email field is required.
The produto field is required.
The quantidade field is required.
```

**POST `/inscricao` com `quantidade=0` e `telefone=123`**

```text
The quantidade field must be at least 1.
The telefone field must be 11 digits.
```

**POST válido**

```http
HTTP/1.1 302 Found
Location: /inscricao

Inscrição recebida: Maria Silva vai trazer 5 de Mel.
```

**Comando `curl.exe -i -X POST http://127.0.0.1:8000/inscricao`, sem carregar o formulário**

```http
HTTP/1.1 419 unknown status
Content-Type: text/html; charset=utf-8

<title>Page Expired</title>
```

### Caminho da requisição

GET `/inscricao` -> `InscricaoController@create` -> view do formulário. POST `/inscricao` -> `InscricaoController@store` -> validação -> redirecionamento para GET `/inscricao` com mensagens de erro ou sucesso na sessão.

### Respostas

a) Quando a validação falha, Laravel redireciona de volta e guarda os dados antigos na sessão. A view usa `old('campo')` para preencher novamente os inputs, evitando que a pessoa precise redigitar os valores.

b) `@csrf` gera um campo oculto `_token` no HTML do formulário. Laravel compara esse token com a sessão da requisição e rejeita o POST se o token esperado estiver ausente ou não for válido.

c) Em um envio válido, `store()` valida os dados e redireciona para a rota GET `inscricao.create`, guardando a mensagem na sessão. A página que o navegador carrega em seguida exibe essa mensagem.

d) O padrão POST/Redirect/GET evita que atualizar a página de resultado reenvie diretamente o POST. O `curl.exe` mostrado faz um POST independente: não carrega primeiro o HTML do formulário, não recebe um cookie de sessão válido e não envia o campo `_token`. A presença de `@csrf` na view apenas gera o campo no HTML; ela não acrescenta token automaticamente a uma requisição separada do curl. Por isso, Laravel rejeita esse POST com status 419 e a resposta contém o título “Page Expired”.
