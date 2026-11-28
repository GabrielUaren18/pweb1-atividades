# Estacionamento Campus

**Aluno:** Gabriel Uaren

**Tema:** Tema 08 - Gestão de Estacionamento

**Problema:** O sistema organiza veículos em um estacionamento e calcula o valor da permanência conforme o tipo.

## Classes do domínio

| Classe | Tipo | Método polimórfico |
|---|---|---|
| `Veiculo` | Classe mãe abstrata | `calcularTarifa()` calcula o valor da permanência |
| `Carro` | Classe filha | Cada hora custa R$ 6,00 |
| `Moto` | Classe filha | Cada hora custa R$ 3,00 |
| `Caminhonete` | Classe filha | Cada hora custa R$ 8,00 |

## Rotas

| Verbo | Endereço | Nome | Quem atende |
|---|---|---|---|
| GET | `/` | `inicio` | Closure e view `inicio` |
| GET | `/sobre` | - | Closure |
| GET | `/status` | - | Closure e JSON |
| GET | `/simular/{quantidade}` | - | Closure e `Carro` |
| GET | `/manutencao` | - | Closure com status 503 |
| GET | `/inicio` | - | Redirect 302 |
| GET | `/veiculos` | `veiculos.index` | `VeiculoController@index` |
| GET | `/veiculos/novo` | `veiculos.create` | `VeiculoController@create` |
| POST | `/veiculos` | `veiculos.store` | `VeiculoController@store` |
| GET | `/veiculos/json` | `veiculos.json` | `VeiculoController@json` |
| GET | `/veiculos/{indice}` | `veiculos.show` | `VeiculoController@show` |
