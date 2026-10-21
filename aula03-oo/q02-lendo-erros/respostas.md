# Questão 02: Lendo erros de objetos

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `erros.php` | Fornecido com quatro erros. Corrija um de cada vez |

## 1. Análise do código

**1.1 Preencha a tabela, na ordem em que os erros apareceram:**

| Rodada | Linha | Tipo da mensagem (Warning ou Fatal error) | O que estava errado | Como corrigiu |
|---|---|---|---|---|
| 1 | 19 e 20 | Warning, Deprecated e Fatal error | O `$nome` foi usado errado depois da setinha, e o semestre estava como texto. | Primeiro troquei `$aluno->$nome` por `$aluno->nome`. |
| 2 | 20 | Fatal error | O semestre estava entre aspas, mas era pra ser um número inteiro. | Tirei as aspas do `3`. |
| 3 | 21 | Fatal error | O curso não tinha recebido nenhum valor. | Coloquei `$aluno->curso = "ADS";`. |
| 4 | 14 | Warning | O `$nome` não existia dentro do método. | Troquei por `$this->nome`. |

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Rodada 1**: `php q02-lendo-erros/erros.php`

```text
PHP Warning:  Undefined variable $nome in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q02-lendo-erros\erros.php on line 19

Warning: Undefined variable $nome in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q02-lendo-erros\erros.php on line 19
PHP Deprecated:  Creation of dynamic property Aluno::$ is deprecated in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q02-lendo-erros\erros.php on line 19

Deprecated: Creation of dynamic property Aluno::$ is deprecated in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q02-lendo-erros\erros.php on line 19
PHP Fatal error:  Uncaught TypeError: Cannot assign string to property Aluno::$semestre of type int in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q02-lendo-erros\erros.php:20
Stack trace:
#0 {main}
  thrown in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q02-lendo-erros\erros.php on line 20

Fatal error: Uncaught TypeError: Cannot assign string to property Aluno::$semestre of type int in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q02-lendo-erros\erros.php:20
Stack trace:
#0 {main}
  thrown in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q02-lendo-erros\erros.php on line 20
```

**2.2 Rodada 2**

```text
PHP Fatal error:  Uncaught TypeError: Cannot assign string to property Aluno::$semestre of type int in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q02-lendo-erros\erros.php:20
Stack trace:
#0 {main}
  thrown in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q02-lendo-erros\erros.php on line 20

Fatal error: Uncaught TypeError: Cannot assign string to property Aluno::$semestre of type int in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q02-lendo-erros\erros.php:20
Stack trace:
#0 {main}
  thrown in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q02-lendo-erros\erros.php on line 20
```

**2.3 Rodada 3**

```text
PHP Fatal error:  Uncaught Error: Typed property Aluno::$curso must not be accessed before initialization in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q02-lendo-erros\erros.php:21
Stack trace:
#0 {main}
  thrown in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q02-lendo-erros\erros.php on line 21

Fatal error: Uncaught Error: Typed property Aluno::$curso must not be accessed before initialization in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q02-lendo-erros\erros.php:21
Stack trace:
#0 {main}
  thrown in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q02-lendo-erros\erros.php on line 21
```

**2.4 Rodada 4**

```text
Curso: ADS
PHP Warning:  Undefined variable $nome in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q02-lendo-erros\erros.php on line 14

Warning: Undefined variable $nome in C:\Users\Gabriel Uaren\Documents\pweb1-atividades - renato william\aula03-oo\q02-lendo-erros\erros.php on line 14
Sou , do 3º semestre.
```

**2.5 Execução final, sem erros**

```text
Curso: ADS
Sou Carla, do 3º semestre.
```

**Explicação:**

O código tinha quatro erros. Fui corrigindo um por um e executando novamente pra ver se tinha resolvido. No final, o programa conseguiu mostrar o curso, o nome e o semestre da aluna sem nenhum erro.

## 3. Perguntas

**a) Na rodada 1 apareceram duas mensagens. Qual delas parou o programa? Qual a diferença entre `Warning` e `Fatal error`?**

Quem parou o programa foi o `Fatal error`, porque tentei colocar um texto no semestre, que era pra ser um número inteiro. O `Warning` só avisa que tem alguma coisa errada, mas o programa continua. Já o `Fatal error` faz ele parar.

**b) Por que o erro do `$curso` só aparece na linha do `echo`, e não na linha do `new Aluno()`?**

Porque o `new Aluno()` só cria o objeto. O erro apareceu quando tentei mostrar o curso sem ter colocado nenhum valor nele antes.

**c) Dentro do método, por que é preciso escrever `$this->nome`, e não só `$nome`?**

Porque `$nome` sozinho seria uma variável dentro do método, só que ela não existe ali. Já o `$this->nome` pega o nome que está guardado no próprio objeto.