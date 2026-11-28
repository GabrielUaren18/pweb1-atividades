# Diário do LLM

## Interação 1
- **Item:** R02
- **LLM:** GitHub Copilot
- **Prompt exato:** "calma, na atividade anterior eu escolhir estacionamento"
- **Resumo:** Corrigiu o tema escolhido inicialmente e orientou o uso de `Veiculo`, `Carro`, `Moto` e `Caminhonete`.
- **Classificação:** B. Funcionou com ajuste: foi necessário trocar os nomes do domínio Feira pelos nomes de Estacionamento.
- **Aprendizado:** O tema deve vir da atividade anterior e não pode ser trocado por suposição.

## Interação 2
- **Item:** R02 e R05
- **LLM:** GitHub Copilot
- **Prompt exato:** Solicitação interna para criar as classes do domínio e o controller com herança e polimorfismo.
- **Resumo:** Gerou uma estrutura com classe mãe abstrata, três filhas e recreação dos objetos a partir de arrays.
- **Classificação:** B. Funcionou com ajuste: corrigiu a sintaxe da rota 503 e ajustou os nomes para Estacionamento.
- **Aprendizado:** A estrutura gerada precisa ser compilada e conferida no projeto real.

## Interação 3
- **Item:** R03
- **LLM:** GitHub Copilot
- **Prompt exato:** Solicitação interna para corrigir a rota `/manutencao` com status 503.
- **Resumo:** Identificou o uso incorreto de `return 'texto', 503` e substituiu por `response('texto', 503)`.
- **Classificação:** C. Não funcionou: ocorreu `ParseError: unexpected token ","`; a correção aplicada foi usar `response('texto', 503)`.
- **Aprendizado:** Em PHP, dois valores separados por vírgula não formam o mesmo retorno que a resposta HTTP completa.

## Interação 4
- **Item:** R04 a R07
- **LLM:** GitHub Copilot
- **Prompt exato:** Solicitação interna para criar layout, menu, listagem, detalhe, JSON e 404.
- **Resumo:** Criou controllers, views, JSON e rota fallback.
- **Classificação:** B. Funcionou com ajuste: alguns arquivos gerados pelo Artisan tinham comentários padrão que precisaram ser substituídos.
- **Aprendizado:** Views e controllers devem ser adaptados ao tema específico.

## Interação 5
- **Item:** R08
- **LLM:** GitHub Copilot
- **Prompt exato:** Solicitação interna para validar e cadastrar veículos usando sessão e exceção de negócio.
- **Resumo:** Implementou `validate()`, `try/catch`, `session()->push()` e redirecionamento com mensagem.
- **Classificação:** B. Funcionou com ajuste: foram alinhados os campos `placa` e `modelo` ao projeto anterior de OO.
- **Aprendizado:** Laravel valida entrada; a classe valida regra de negócio.

## Casos de teste da regra

| Entrada | Resultado esperado pelo LLM | Resultado real | Acertou? |
|---|---|---|---|
| `Carro('ABC1D23', 'Sedan'); calcularTarifa(2)` | `12.0` | Verificado no tinker | Sim |
| `Moto('XYZ2E34', 'CG 160'); calcularTarifa(1.5)` | `4.5` | Verificado no tinker | Sim |
| `Moto('XYZ2E34', 'CG 160'); calcularTarifa(2)` | `6.0` | Verificado no tinker | Sim |
| `Caminhonete('BRA3F45', 'Hilux'); calcularTarifa(2)` | `16.0` | Verificado no tinker | Sim |
| `Carro('', 'Sedan');` | `InvalidArgumentException` | Verificado no tinker | Sim |
| Caso adicional: horas iguais a zero em `Moto` | `InvalidArgumentException` | Verificado no tinker | Sim |

## Verificação de uma explicação

Prompt: "Qual a diferença entre `abort(404)` e `Route::fallback`?"

A resposta foi considerada **correta e incompleta**: explicou que `abort(404)` trata um recurso inexistente dentro da rota e o fallback trata uma URL que não corresponde a nenhuma rota. Completei conferindo a documentação oficial do Laravel em https://laravel.com/docs/errors e https://laravel.com/docs/routing. A documentação confirma que o fallback é usado quando nenhum outro padrão de rota corresponde, enquanto `abort(404)` gera uma exceção HTTP 404 em qualquer ponto da execução.

## Resumo

- **A:** 0
- **B:** 4
- **C:** 1
- **D:** 0

O LLM ajudou a estruturar rapidamente classes, rotas e views. Corrigi tema, sintaxe e nomes gerados. Ele atrapalhou quando presumiu o tema correto sem verificar a atividade anterior, por isso o primeiro resultado precisou ser substituído.
