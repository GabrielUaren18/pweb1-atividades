
<?php

// =====================================================
// PROJETO V2 - PERFIL DO ESTUDANTE COM CLASSES
// Toda a lógica PHP fica antes do HTML.
// =====================================================


// 1. CLASSE PROJETO

// Essa classe guarda as informações de cada projeto.
class Projeto
{
    // Os atributos são privados para proteger os dados.
    private string $titulo;
    private string $descricao;
    private string $tecnologias;

    // O construtor recebe os dados quando criamos um projeto.
    public function __construct(
        string $titulo,
        string $descricao,
        string $tecnologias
    ) {
        // Não deixa criar um projeto com título vazio.
        if (trim($titulo) === '') {
            throw new Exception("O projeto precisa de um título.");
        }

        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->tecnologias = $tecnologias;
    }

    // Os getters permitem consultar os dados privados.
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getTecnologias(): string
    {
        return $this->tecnologias;
    }

    // Converte o projeto em array para usar no JSON.
    public function paraArray(): array
    {
        return [
            "titulo" => $this->titulo,
            "descricao" => $this->descricao,
            "tecnologias" => $this->tecnologias
        ];
    }
}


// 2. CLASSE PERFIL

// Essa classe guarda os dados do estudante e seus projetos.
class Perfil
{
    private string $nome;
    private string $curso;
    private string $campus;
    private string $cidade;
    private string $apresentacao;

    private array $habilidades;
    private array $projetos = [];

    // Recebe os dados necessários para criar o perfil.
    public function __construct(
        string $nome,
        string $curso,
        string $campus,
        string $cidade,
        string $apresentacao,
        array $habilidades
    ) {
        // O perfil precisa ter pelo menos cinco habilidades.
        if (count($habilidades) < 5) {
            throw new Exception(
                "O perfil precisa de pelo menos 5 habilidades."
            );
        }

        $this->nome = $nome;
        $this->curso = $curso;
        $this->campus = $campus;
        $this->cidade = $cidade;
        $this->apresentacao = $apresentacao;
        $this->habilidades = $habilidades;
    }

    // Adiciona um projeto e gera seu ID automaticamente.
    public function adicionarProjeto(Projeto $projeto): void
    {
        $id = count($this->projetos) + 1;
        $this->projetos[$id] = $projeto;
    }

    // Procura um projeto pelo ID.
    public function getProjeto(int $id): Projeto
    {
        // Se o projeto não existir, lança uma exceção.
        if (!isset($this->projetos[$id])) {
            throw new Exception("Projeto não encontrado.");
        }

        return $this->projetos[$id];
    }

    // Getters para consultar as informações do estudante.
    public function getNome(): string
    {
        return $this->nome;
    }

    public function getCurso(): string
    {
        return $this->curso;
    }

    public function getCampus(): string
    {
        return $this->campus;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function getApresentacao(): string
    {
        return $this->apresentacao;
    }

    public function getHabilidades(): array
    {
        return $this->habilidades;
    }

    public function getProjetos(): array
    {
        return $this->projetos;
    }

    // Converte os dados do perfil e dos projetos em arrays.
    public function paraArray(): array
    {
        $projetos = [];

        // Cada objeto Projeto também vira um array.
        foreach ($this->projetos as $id => $projeto) {
            $projetos[$id] = $projeto->paraArray();
        }

        return [
            "nome" => $this->nome,
            "curso" => $this->curso,
            "campus" => $this->campus,
            "cidade" => $this->cidade,
            "apresentacao" => $this->apresentacao,
            "habilidades" => $this->habilidades,
            "projetos" => $projetos
        ];
    }
}


// 3. CRIAÇÃO DOS OBJETOS

// Criamos o perfil com as informações do estudante.
$perfil = new Perfil(
    "Gabriel Uaren",
    "Análise e Desenvolvimento de sistema",
    "IFCE CAMPUS BOA VIAGEM",
    "Boa Viagem",
    "Tenho 19 anos, durante meu ensino médio fiz o curso de téc de adm, mas hoje em dia estou na área de T.I, mas precisamente no curso de ADS",
    [
        "Comunicação",
        "Organização",
        "Trabalho em equipe",
        "Resolução de problemas",
        "Criatividade"
    ]
);

// Criamos os três projetos e adicionamos ao perfil.
$perfil->adicionarProjeto(new Projeto(
    "Curadoria de Livros Nacionais",
    "Site para apresentar livros nacionais, seus autores e gêneros literários.",
    "Html, Java Script e Css"
));

$perfil->adicionarProjeto(new Projeto(
    "Calcula dois números",
    "Calcula dois números",
    "PHP"
));

$perfil->adicionarProjeto(new Projeto(
    "Vantage",
    "O Vantage ajuda pequenos empresários a organizar suas finanças e separar o dinheiro pessoal do empresarial.",
    "Ionic/Angular e Python"
));


// 4. TEMA CLARO OU ESCURO

// Primeiro verifica a URL, depois o cookie e, por último, usa claro.
$tema = $_GET["tema"] ?? $_COOKIE["tema"] ?? "claro";

// Só aceita os dois temas disponíveis.
if ($tema !== "claro" && $tema !== "escuro") {
    $tema = "claro";
}

// Guarda o tema no cookie por 30 dias.
if (isset($_GET["tema"])) {
    setcookie(
        "tema",
        $tema,
        time() + 60 * 60 * 24 * 30,
        "/"
    );
}


// 5. ROTA JSON

// Se a URL pedir JSON, devolvemos os dados e encerramos.
if (($_GET["formato"] ?? "") === "json") {
    header("Content-Type: application/json; charset=utf-8");

    // Pega os dados do objeto Perfil.
    $dados = $perfil->paraArray();

    // Separa os projetos para manter o formato da V1.
    $projetosJson = $dados["projetos"];
    unset($dados["projetos"]);

    echo json_encode(
        [
            "perfil" => $dados,
            "projetos" => $projetosJson
        ],
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );

    exit;
}


// 6. CONTROLE DAS PÁGINAS

// Descobre qual página o usuário quer acessar.
$pagina = $_GET["pagina"] ?? "inicio";

// Pega o ID do projeto pela URL.
$id = (int) ($_GET["id"] ?? 0);

// Começamos sem nenhum projeto selecionado.
$projetoSelecionado = null;
$erroProjeto = null;

// Quando a página for de detalhes, procuramos o projeto.
if ($pagina === "projeto") {
    try {
        $projetoSelecionado = $perfil->getProjeto($id);
    } catch (Exception $erro) {
        // Se não encontrar, mostramos a mensagem e retornamos 404.
        $erroProjeto = $erro->getMessage();
        http_response_code(404);
    }
}

// Uma página que não existe também retorna 404.
if (!in_array(
    $pagina,
    ["inicio", "habilidades", "projetos", "projeto"],
    true
)) {
    http_response_code(404);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Meu perfil</title>

    <link rel="stylesheet" href="estilo.css">
</head>

<body class="tema-<?= htmlspecialchars($tema) ?>">

    <header>

        <!-- O nome e o curso agora vêm dos getters. -->
        <h1><?= htmlspecialchars($perfil->getNome()) ?></h1>

        <p><?= htmlspecialchars($perfil->getCurso()) ?></p>

        <nav>
            <a href="?pagina=inicio">Início</a>

            <a href="?pagina=habilidades">Habilidades</a>

            <a href="?pagina=projetos">Projetos</a>

            <!-- Mantém a página atual ao mudar o tema. -->
            <a href="?pagina=<?= urlencode($pagina) ?>&id=<?= $id ?>&tema=<?= $tema === "claro" ? "escuro" : "claro" ?>">
                Mudar tema
            </a>
        </nav>

    </header>

    <main>

        <?php if ($pagina === "inicio"): ?>

            <h2>Sobre mim</h2>

            <p><?= htmlspecialchars($perfil->getNome()) ?></p>

            <p>
                Curso:
                <?= htmlspecialchars($perfil->getCurso()) ?>
            </p>

            <p>
                Campus:
                <?= htmlspecialchars($perfil->getCampus()) ?>
            </p>

            <p>
                Cidade:
                <?= htmlspecialchars($perfil->getCidade()) ?>
            </p>

            <p>
                Apresentação:
                <?= htmlspecialchars($perfil->getApresentacao()) ?>
            </p>


        <?php elseif ($pagina === "habilidades"): ?>

            <h2>Minhas habilidades</h2>

            <!-- Junta as habilidades em um único texto. -->
            <p>
                <?= htmlspecialchars(
                    implode(", ", $perfil->getHabilidades())
                ) ?>
            </p>

            <!-- Conta quantas habilidades o perfil possui. -->
            <p>
                Total de habilidades:
                <?= count($perfil->getHabilidades()) ?>
            </p>


        <?php elseif ($pagina === "projetos"): ?>

            <h2>Meus projetos</h2>

            <!-- Percorre os objetos Projeto guardados no Perfil. -->
            <?php foreach ($perfil->getProjetos() as $id => $projeto): ?>

                <h3>
                    <?= htmlspecialchars($projeto->getTitulo()) ?>
                </h3>

                <p>
                    <?= htmlspecialchars($projeto->getDescricao()) ?>
                </p>

                <p>
                    Tecnologias:
                    <?= htmlspecialchars($projeto->getTecnologias()) ?>
                </p>

                <a href="?pagina=projeto&id=<?= $id ?>">
                    Ver detalhes
                </a>

            <?php endforeach; ?>


        <?php elseif ($pagina === "projeto"): ?>

            <!-- Mostra os detalhes se o projeto foi encontrado. -->
            <?php if ($projetoSelecionado !== null): ?>

                <h2>
                    <?= htmlspecialchars(
                        $projetoSelecionado->getTitulo()
                    ) ?>
                </h2>

                <p>
                    <?= htmlspecialchars(
                        $projetoSelecionado->getDescricao()
                    ) ?>
                </p>

                <p>
                    Tecnologias:
                    <?= htmlspecialchars(
                        $projetoSelecionado->getTecnologias()
                    ) ?>
                </p>

                <a href="?pagina=projetos">
                    Voltar aos projetos
                </a>

            <?php else: ?>

                <!-- Mostra a mensagem da exceção quando o ID não existe. -->
                <h2>
                    <?= htmlspecialchars(
                        $erroProjeto ?? "Projeto não encontrado."
                    ) ?>
                </h2>

            <?php endif; ?>


        <?php else: ?>

            <h2>Página não encontrada</h2>

        <?php endif; ?>

    </main>

    <footer>

        <p>
            Tema atual:
            <?= htmlspecialchars($tema) ?>
        </p>

        <a href="?formato=json">Ver JSON</a>

        <p>&copy; <?= date("Y") ?></p>

    </footer>

</body>
</html>
