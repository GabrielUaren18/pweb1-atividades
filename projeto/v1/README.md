# Perfil do Estudante: versão 1

**Autor(a):** Gabriel Uaren

## Como executar

Abra o terminal na pasta do repositório e execute:

```powershell
cd projeto/v1
php -S localhost:8000 -d display_errors=1 -d output_buffering=0
```

Abra http://localhost:8000

## Telas

| Tema claro | Tema escuro |
|---|---|
| ![Tema claro](prints/claro.png) | ![Tema escuro](prints/escuro.png) |

## 1. Mapa de rotas

| URL | O que mostra | Status |
|---|---|---|
| `/` | Página inicial com minhas informações | 200 OK |
| `/?pagina=habilidades` | Minhas habilidades e a quantidade delas | 200 OK |
| `/?pagina=projetos` | Lista dos três projetos | 200 OK |
| `/?pagina=projeto&id=1` | Detalhes do primeiro projeto | 200 OK |
| `/?pagina=projeto&id=99` | Projeto não encontrado | 404 Not Found |
| `/?pagina=qualquercoisa` | Página não encontrada | 404 Not Found |
| `/?tema=escuro` | Página inicial com tema escuro | 200 OK |
| `/?formato=json` | Dados do perfil e dos projetos em JSON | 200 OK |

## 2. Saídas do terminal

### 2.1 Uma página que existe

**Comando:**

`curl.exe -i "http://localhost:8000/?pagina=habilidades"`

**Saída do terminal:**

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 14 Oct 2026 15:20:05 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Content-type: text/html; charset=UTF-8

<!DOCTYPE html>
```

**Explicação:**

O código 200 OK significa que a página de habilidades foi encontrada e funcionou normalmente. O Content-Type informa que o servidor está enviando uma página HTML. Nela aparecem minhas cinco habilidades, que são mostradas usando as funções `implode()` e `count()`.

### 2.2 Uma página que não existe

**Comando:**

`curl.exe -i "http://localhost:8000/?pagina=projeto&id=99"`

**Saída do terminal:**

```text
HTTP/1.1 404 Not Found
Host: localhost:8000
Date: Wed, 14 Oct 2026 15:06:36 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Content-type: text/html; charset=UTF-8
```

**Explicação:**

O código 404 significa que o projeto solicitado não existe. No PHP, usei `isset()` para verificar se o projeto está cadastrado e `http_response_code(404)` para informar o erro.

### 2.3 A troca de tema

**Comando:**

`curl.exe -i "http://localhost:8000/?tema=escuro"`

**Saída do terminal:**

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 14 Oct 2026 14:49:43 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Set-Cookie: tema=escuro; expires=Fri, 13 Nov 2026 14:49:43 GMT; Max-Age=2592000; path=/
Content-type: text/html; charset=UTF-8

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Meu perfil</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body class="tema-escuro">
```

**Explicação:**

O cabeçalho `Set-Cookie` salva o tema escuro no navegador por 30 dias. Quando a pessoa entra novamente no site, o PHP usa `$_COOKIE` para recuperar o tema escolhido. Assim, ela não precisa selecionar o tema toda vez.

### 2.4 A API

**Comando:**

`curl.exe -i "http://localhost:8000/?formato=json"`

**Saída do terminal:**

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 14 Oct 2026 15:22:40 GMT
Connection: close
X-Powered-By: PHP/8.5.11
Content-Type: application/json; charset=utf-8

{
    "perfil": {
        "nome": "Gabriel Uaren",
        "curso": "Análise e Desenvolvimento de sistema",
        "campus": "IFCE CAMPUS BOA VIAGEM",
        "cidade": "Boa Viagem",
        "apresentacao": "Tenho 19 anos, durante meu ensino médio fiz o curso de téc de adm, mas hoje em dia estou na área de T.I, mas precisamente no curso de ADS",
        "habilidades": [
            "Comunicação",
            "Organização",
            "Trabalho em equipe",
            "Resolução de problemas",
            "Criatividade"
        ]
    },
    "projetos": {
        "1": {
            "titulo": "Curadoria de Livros Nacionais",
            "descricao": "Site para apresentar livros nacionais, seus autores e gêneros literários.",
            "tecnologias": "Html, Java Script e Css"
        },
        "2": {
            "titulo": "Calcula dois números",
            "descricao": "Calcula dois números",
            "tecnologias": "PHP"
        },
        "3": {
            "titulo": "Vantage",
            "descricao": "O Vantage ajuda pequenos empresários a organizar suas finanças e separar o dinheiro pessoal do empresarial.",
            "tecnologias": "Ionic\/Angular e Python"
        }
    }
}
```

**Explicação:**

Quando a URL recebe `formato=json`, o PHP retorna os dados do perfil e dos projetos em formato JSON, em vez de mostrar o site normal. Usei `header()` para informar o tipo de conteúdo e `json_encode()` para transformar os arrays em JSON.

### 2.5 Log do servidor das quatro requisições acima

**Saída do terminal:**

[Wed Oct 14 12:20:05 2026] [::1]:65156 [200]: GET /?pagina=habilidades
[Wed Oct 14 12:06:36 2026] [::1]:65421 [404]: HEAD /?pagina=projeto&id=99
[Wed Oct 14 11:49:43 2026] [::1]:65022 [200]: GET /?tema=escuro
[Wed Oct 14 12:22:40 2026] [::1]:55864 [200]: GET /?formato=json

**Explicação:**

O log mostra os acessos feitos ao servidor PHP. O código 200 significa que a requisição funcionou normalmente, enquanto o 404 indica que o projeto não foi encontrado. Também aparecem o horário, o endereço acessado e o método utilizado, como GET e HEAD.

## 3. Onde usei cada conceito

| Conceito | Linha(s) do `index.php` | Para que usei |
|---|---|---|
| Array associativo | Declaração de `$perfil` e `$projetos` | Para guardar as informações do perfil e dos projetos |
| `$_GET` e `??` | Leitura de `tema`, `pagina`, `id` e `formato` | Para pegar informações da URL e definir valores padrão |
| `if` / `elseif` / `else` | Condições das páginas | Para decidir qual conteúdo mostrar |
| `htmlspecialchars` | Exibição dos dados no HTML | Para mostrar os textos com mais segurança |
| `setcookie` e `$_COOKIE` | Parte de escolha do tema | Para salvar e recuperar o tema escolhido |
| `http_response_code(404)` | Verificação de páginas e projetos | Para retornar o erro 404 quando algo não existe |
| `header` e `json_encode` | Rota JSON | Para informar o formato da resposta e transformar os arrays em JSON |
| `implode` e `count` | Página de habilidades | Para juntar as habilidades em um texto e contar quantas existem |

**Observação:** substituir as descrições da segunda coluna pelos números exatos das linhas do `index.php`, conforme solicitado pelo professor.

## 4. Decisões e dificuldades

### 4.1 Por que toda a lógica PHP fica no topo do arquivo, antes do HTML?

Porque algumas funções, como `header()`, `setcookie()` e `http_response_code()`, precisam ser executadas antes de o servidor começar a enviar o HTML. Assim, evitamos erros e deixamos o código mais organizado.

### 4.2 Por que o tema escolhido na URL precisa ser validado?

Para garantir que o usuário escolha apenas entre claro e escuro. Se alguém colocar um valor diferente na URL, o sistema usa o tema claro como padrão. Isso evita valores inesperados e ajuda a manter o funcionamento do site.

### 4.3 Qual foi a maior dificuldade e como você resolveu?

Minha maior dificuldade foi organizar o código PHP junto com o HTML, principalmente as condições `if`, `elseif` e `else`. Também tive dificuldade para entender o funcionamento dos cookies e posicionar corretamente a tag `main`.

Consegui resolver revisando o código, corrigindo os erros e fazendo testes no terminal e no navegador. Esses testes me ajudaram a entender melhor como o PHP funciona na prática.