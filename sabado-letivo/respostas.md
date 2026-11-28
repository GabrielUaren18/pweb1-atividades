# Respostas da atividade

## R02 - Tinker

```text
12.0
6.0
16.0
array:4 [
  "placa" => "ABC1D23",
  "modelo" => "Sedan",
  "tipo" => "carro",
]
"Placa e modelo são obrigatórios."
```

O nome do arquivo precisa ser igual ao nome da classe porque o autoload PSR-4 procura o caminho derivado da classe e do namespace. A pasta corresponde ao namespace `App\Domain\Estacionamento`, que é traduzida para `app/Domain/Estacionamento`.

## R03 - HTTP

`/status`:

```text
HTTP/1.1 200 OK
Content-Type: application/json
{"sistema":"Estacionamento Campus","tema":"Tema 08: gest\u00e3o de estacionamento","autor":"Gabriel Uaren","versao":"1.0"}
```

`/manutencao`:

```text
HTTP/1.1 503 Service Unavailable
Content-Type: text/html; charset=utf-8
Sistema em manutenção
```

`/inicio`:

```text
HTTP/1.1 302 Found
Location: http://127.0.0.1:8000
```

Em `/simular/abc`, o status foi `404 Not Found`: o vínculo `where` da rota não aceitou `abc`, então a rota não entrou em execução e o Router respondeu por falta de correspondência.

Em `/simular`, participam a rota em `routes/web.php`, a classe `Carro` do domínio e a resposta HTTP gerada pela closure. A classe do domínio representa a camada de domínio/Modelo; não é View nem Controller.

## R04 - Blade

A página inicial juntou `inicio.blade.php`, `layouts/app.blade.php` e `partials/menu.blade.php`: a view usa `@extends`, o layout inclui o menu e o layout insere o conteúdo em `@yield`.

Os links usam `route('inicio')` porque o nome da rota continua correto mesmo se o endereço mudar; `href="/"` é uma URL fixa.

## R05 - Polimorfismo

A linha `calcularTarifa(2)` retorna resultados diferentes porque a variável `$veiculo` pode conter objetos de classes filhas diferentes. Cada filha implementa o método com sua própria tarifa: carro R$6/h, moto R$3/h e caminhonete R$8/h. Isso é polimorfismo.

O caminho é `GET /veiculos -> route -> VeiculoController@index -> itens() cria objetos do domínio -> view veiculos.index -> HTML 200`.

## R06 - 404

`/veiculos/99` respondeu com a página padrão de 404 gerada por `abort(404)`, porque o índice não existe no array.

`/qualquer-coisa` respondeu com `404` pela view própria `nao-encontrada`, criada pelo `Route::fallback`.

```text
/veiculos/99
HTTP/1.1 404 Not Found
Content-Type: text/html; charset=utf-8

/qualquer-coisa
HTTP/1.1 404 Not Found
Content-Type: text/html; charset=utf-8
```

## R07 - JSON

`curl.exe -i http://127.0.0.1:8000/veiculos/json`:

```text
HTTP/1.1 200 OK
Content-Type: application/json
[{"placa":"ABC1D23","modelo":"Sedan","tipo":"carro"},{"placa":"XYZ2E34","modelo":"CG 160","tipo":"moto"},{"placa":"BRA3F45","modelo":"Hilux","tipo":"caminhonete"}]
```

Ao devolver diretamente os objetos com `response()->json($this->itens())`, os atributos private não deveriam aparecer em um JSON legível, pois não há getter JSON para esses atributos. `paraArray()` transforma o objeto em dados públicos controlados pelo método do domínio.

## R08 - Cadastro

Testes realizados:

1. Formulário vazio: validação exigiu tipo, placa e modelo.
2. Modelo vazio: a validação exigiu pelo menos dois caracteres.
3. Placa vazia: a classe `Veiculo` lançou `InvalidArgumentException`; o `catch` enviou a mensagem ao campo `placa` e manteve os dados digitados.
4. Cadastro certo com `tipo=carro`, `placa=TEST1A8` e `modelo=Sedan`: houve redirecionamento 302 para `/veiculos`, a sessão mostrou a mensagem de sucesso e o veículo apareceu na lista.

POST sem CSRF:

```text
HTTP/1.1 419 unknown status
Content-Type: text/html; charset=utf-8
```

O status 419 ocorre porque o middleware CSRF não encontrou token válido. O caminho do cadastro correto teve duas requisições: GET `/veiculos/novo` para o formulário e POST `/veiculos` para validar, criar o objeto, salvar os dados na sessão e redirecionar.

O Laravel utilizado é 13.44.1. O projeto guarda a sessão no driver configurado pelo `.env` e os dados armazenados são arrays simples, não objetos com atributos private. Isso evita problemas de serialização.

## R10 - Route list

```text
GET|HEAD / .. inicio › routes/web.php:33
GET|HEAD inicio .. routes/web.php:31
GET|HEAD manutencao .. routes/web.php:27
GET|HEAD simular/{quantidade} .. routes/web.php:20
GET|HEAD sobre .. routes/web.php:7
GET|HEAD status .. routes/web.php:11
GET|HEAD veiculos .. veiculos.index › VeiculoController@index
POST veiculos .. veiculos.store › VeiculoController@store
GET|HEAD veiculos/json .. veiculos.json › VeiculoController@json
GET|HEAD veiculos/novo .. veiculos.create › VeiculoController@create
GET|HEAD veiculos/{indice} .. veiculos.show › VeiculoController@show
GET|HEAD {fallbackPlaceholder} .. routes/web.php:48
```

Fluxos escolhidos:

```text
GET /sobre -> rota closure em web.php -> texto -> HTML 200

GET /veiculos -> rota web.php -> VeiculoController@index -> objetos de App\Domain\Estacionamento -> view veiculos.index -> HTML 200

GET /veiculos/json -> rota web.php -> VeiculoController@json -> paraArray() -> response()->json -> JSON 200
```

## Revisão

1. HTTP: os verbos definem a operação; status 200 indica sucesso, 302 redirecionamento, 404 recurso inexistente e 503 indisponibilidade.
2. PHP: arrays associativos guardam dados; funções podem validar e formatar; GET lê URL e POST envia formulário.
3. POO: abstração representa a classe mãe, encapsulamento protege atributos, herança compartilha dados e polimorfismo permite implementações diferentes.
4. Laravel: a rota recebe a requisição, o controller decide o fluxo, a view apresenta o resultado e o domínio contém regras de negócio.
5. Validação: `validate()` confirma formato dos campos; `try/catch` trata uma exceção lançada pela regra da classe.
6. Sessão: guarda dados entre requisições e permite que um cadastro apareça na próxima página.
7. Blade: layout reutiliza estrutura e `@yield` define pontos de inserção.
