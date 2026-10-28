<?php
// =====================================================================
// Projeto integrador v1: Perfil do Estudante
// Siga os requisitos do enunciado. Mantenha esta ordem:
// toda a lógica em PHP no topo, e o HTML só depois.
// =====================================================================

// 1. Dados do perfil (R2)
//    Crie o array $perfil e o array $projetos.


$perfil  = [

  "nome" => "Gabriel Uaren",
  "curso" => "Análise e Desenvolvimento de sistema",
  "campus" => "IFCE CAMPUS BOA VIAGEM",
  "cidade" => "Boa Viagem",
  "apresentacao" => "Tenho 19 anos, durante meu ensino médio fiz o curso de téc de adm, mas hoje em dia estou na área de T.I, mas precisamente no curso de ADS",
  "habilidades" => ["Comunicação", "Organização",  "Trabalho em equipe", "Resolução de problemas", "Criatividade" ]

]; //bom, isso é um array associativo, pra que serve? guarda várias informações

$projetos = [

  1 => [

 "titulo" => "Curadoria de Livros Nacionais",
 "descricao" =>  "Site para apresentar livros nacionais, seus autores e gêneros literários.",
 "tecnologias" => "Html, Java Script e Css"


  ],

  2 => [

  "titulo" => "Calcula dois números",
  "descricao" => "Calcula dois números",
  "tecnologias" => "PHP"

  ],


 3 => [

  "titulo" => "Vantage",
  "descricao" => "O Vantage ajuda pequenos empresários a organizar suas finanças e separar o dinheiro pessoal do empresarial.",
  "tecnologias" => "Ionic/Angular e Python"

 ],

];
// 2. Tema claro ou escuro (R5 e R6)
//    Leia o tema da URL ou do cookie, valide e grave o cookie.

$tema = $_GET["tema"] ?? $_COOKIE["tema"] ?? "claro";

if ($tema !== "claro" && $tema !== "escuro") {
  $tema = "claro";

}

if (isset($_GET["tema"])) {
    setcookie("tema", $tema, time() + 60 * 60 * 24 * 30, "/");
}

// 3. Rota JSON (R7)
//    Se a URL tiver ?formato=json, envie o cabeçalho, o JSON e encerre com exit.

if (($_GET["formato"]?? "") === "json") {

  header("Content-Type: application/json; charset=utf-8");

  echo json_encode(
    ["perfil" => $perfil, "projetos" => $projetos],
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE

  );

  exit;

}


// 4. Qual página mostrar (R3 e R4)
//    Leia ?pagina= e decida o conteúdo com if/elseif. Página inexistente: 404.

$pagina = $_GET["pagina"] ?? "inicio";

$id = (int) ($_GET["id"] ?? 0);

if ($pagina === "projeto" && !isset($projetos[$id])) {

http_response_code(404);


}

if (!in_array($pagina, ["inicio",  "habilidades", "projetos", "projeto"])) {
  http_response_code(404); }


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Meu perfil</title>
  <link rel="stylesheet" href="estilo.css">
</head>

<body class="tema-<?=  htmlspecialchars($tema) ?>">

  <header>
    <h1><?= htmlspecialchars($perfil["nome"]) ?></h1>

    <p><?= htmlspecialchars($perfil["curso"]) ?></p>

    <nav>
        <a href="?pagina=inicio">Início</a>
        <a href="?pagina=habilidades">Habilidades</a>
        <a href="?pagina=projetos">Projetos</a>

        <a href="?pagina=<?= urlencode($pagina) ?>&id=<?= $id ?>&tema=<?= $tema === "claro" ? "escuro" : "claro" ?>">
        Mudar tema
    </a>
    </nav>
</header>

<main>

<?php if ($pagina === "inicio"): ?>

  <h2>Sobre mim</h2>

  <p><?=  htmlspecialchars(($perfil["nome"])) ?></p>

  <p>Curso: <?=  htmlspecialchars(($perfil["curso"])) ?></p>
  
  <p>Campus: <?=  htmlspecialchars(($perfil["campus"])) ?></p>

  <p>Cidade: <?=  htmlspecialchars(($perfil["cidade"])) ?></p>

  <p>Apresentação: <?=  htmlspecialchars(($perfil["apresentacao"])) ?></p>

<?php elseif ($pagina === "habilidades"): ?>

  <h2>Minhas habilidades</h2>

<p><?=  htmlspecialchars(implode(", ", $perfil["habilidades"])) ?></p>

<p>Total de habilidades: <?= count($perfil["habilidades"]) ?></p>

<?php elseif ($pagina === "projetos"): ?>

  <h2>Meus projetos</h2>

  <?php foreach ($projetos as $id => $projeto): ?>

    <h3><?=  htmlspecialchars($projeto["titulo"]) ?></h3>

    <p><?=  htmlspecialchars($projeto["descricao"]) ?></p>

    <p>Tecnologias: <?=  htmlspecialchars($projeto["tecnologias"]) ?></p>

    <a href="?pagina=projeto&id=<?= $id ?>">Ver detalhes</a>

  <?php endforeach; //para cada projeto dentro do array $projetos, pegue seu número e suas informações. ?> 

    <?php elseif ($pagina === "projeto"): ?>

    <?php if (isset($projetos[$id])): ?>

        <h2><?= htmlspecialchars($projetos[$id]["titulo"]) ?></h2>

        <p><?= htmlspecialchars($projetos[$id]["descricao"]) ?></p>

        <p>Tecnologias: <?= htmlspecialchars($projetos[$id]["tecnologias"]) ?></p>

        <a href="?pagina=projetos">Voltar aos projetos</a>

<?php else: ?>

    <h2>Projeto não encontrado</h2>

<?php endif; ?>

<?php else: ?>

    <h2>Página não encontrada</h2>

<?php endif; ?>


   
</main>


<footer>
    <p>Tema atual: <?= htmlspecialchars($tema) ?></p>

    <a href="?formato=json">Ver JSON</a>

    <p>&copy; <?= date("Y") ?></p>
</footer>

</body>
</html>