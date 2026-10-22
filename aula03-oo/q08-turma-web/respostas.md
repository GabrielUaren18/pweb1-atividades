# Questão 08: Desafio: a turma na web

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `turma.php` | Você cria do zero: as classes `Aluno` e `Disciplina` e a página HTML |

## 1. Análise do código

**1.1 Desenhe (em texto ou tabela) as duas classes: atributos com tipo e visibilidade e métodos com tipo de retorno.**

**Classe Aluno**

| Atributo | Tipo | Visibilidade |
|---|---|---|
| `$nome` | string | private |
| `$nota1` | float | private |
| `$nota2` | float | private |

| Método | Retorno | Visibilidade |
|---|---|---|
| `__construct()` | Sem retorno | public |
| `getNome()` | string | public |
| `calcularMedia()` | float | public |
| `situacao()` | string | public |

**Classe Disciplina**

| Atributo | Tipo | Visibilidade |
|---|---|---|
| `$nome` | string | private |
| `$alunos` | array | private |

| Método | Retorno | Visibilidade |
|---|---|---|
| `__construct()` | Sem retorno | public |
| `getNome()` | string | public |
| `getAlunos()` | array | public |
| `adicionarAluno()` | void | public |
| `calcularMediaTurma()` | float | public |
| `contarAprovados()` | int | public |

**1.2 Explique `adicionarAluno(Aluno $aluno)`: o que significa um parâmetro do tipo de uma classe?**

Significa que esse método só aceita um objeto da classe `Aluno`. Não posso simplesmente passar um nome como texto, preciso criar um aluno usando `new Aluno()`. Isso ajuda a evitar que sejam colocados dados errados na lista.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Resposta da página:** `curl.exe -i http://localhost:8000/q08-turma-web/turma.php`

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Thu, 22 Oct 2026 00:09:26 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Content-type: text/html; charset=UTF-8

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Turma - Programação Web I</title>
</head>
<body>

    <h1>Programação Web I</h1>

    <table border="1">
        <tr>
            <th>Aluno</th>
            <th>Média</th>
            <th>Situação</th>
        </tr>

        <tr>
            <td>Ana</td>
            <td>8,75</td>
            <td>Aprovado</td>
        </tr>
        <tr>
            <td>Bruno</td>
            <td>5,50</td>
            <td>Reprovado</td>
        </tr>
        <tr>
            <td>Caio</td>
            <td>2,75</td>
            <td>Reprovado</td>
        </tr>
        <tr>
            <td>Daniela</td>
            <td>7,00</td>
            <td>Aprovado</td>
        </tr>
    </table>

    <p>Média da turma: 6,00</p>
    <p>Aprovados: 2 de 4</p>

</body>
</html>
```

**Explicação:**

A página abriu normalmente e mostrou os quatro alunos com suas médias e situações. No final, apareceu a média da turma, que ficou em 6,00, e a quantidade de aprovados, que foram 2 de 4.

**2.2 Trecho da resposta com `?teste=1`:** `curl.exe -s "http://localhost:8000/q08-turma-web/turma.php?teste=1"`

```text
<p>Nota inválida para Eduardo: use valores de 0 a 10.</p>

<h1>Programação Web I</h1>

Média da turma: 6,00
Aprovados: 2 de 4
```

**Explicação:**

Quando coloquei `?teste=1` na URL, o sistema tentou cadastrar Eduardo com nota 11. Como a nota passou de 10, o PHP recusou o cadastro e mostrou a mensagem de erro. Os outros quatro alunos continuaram normalmente.

## 2.3 Log do servidor das duas requisições

[Wed Oct 21 21:09:26 2026] [::1]:49638 [200]: GET /q08-turma-web/turma.php
[Wed Oct 21 21:09:45 2026] [::1]:60406 [200]: GET /q08-turma-web/turma.php?teste=1

**Explicação:**

O log mostra os acessos feitos ao servidor. Cada vez que abri a página, o PHP recebeu uma nova requisição e executou o código novamente.

**2.4 Erro ao passar um texto para `adicionarAluno` (pergunta a)**

```text
Fatal error: Uncaught TypeError:
Disciplina::adicionarAluno(): Argument #1 ($aluno) must be of type Aluno, string given
```

**Explicação:**

Tentei adicionar Eduardo passando apenas o nome dele como texto, mas o PHP não aceitou. Isso aconteceu porque o método só recebe objetos da classe `Aluno`.

## 3. Perguntas

**a) O que acontece ao chamar `$pweb->adicionarAluno('Eduardo')`? Por quê?**

O PHP mostra um erro chamado `TypeError`, porque o método espera receber um objeto da classe `Aluno`, mas eu passei uma string. Para funcionar, teria que criar um objeto `Aluno` com nome e notas.

**b) Os objetos `Aluno` continuam na memória do servidor entre uma requisição e outra? Use o log para justificar.**

Não. Cada vez que a página é acessada, o PHP executa o código novamente e cria os objetos. O log mostra que são requisições diferentes. Quando uma requisição termina, os objetos daquela execução não ficam guardados para a próxima.

**c) Por que `calcularMediaTurma()` verifica se a lista está vazia antes de dividir?**

Porque, se não tiver nenhum aluno, a quantidade seria zero. Aí o PHP tentaria dividir por zero e daria erro. Por isso, o método verifica antes e retorna 0.0 quando a lista está vazia.