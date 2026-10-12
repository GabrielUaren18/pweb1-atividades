<?php

/* cod do renato
$nome = $_GET['nome'];
echo "Olá, " . $nome;
*/


$nome = $_GET['nome'] ?? "Visitante";

$nome = htmlspecialchars($nome, ENT_QUOTES, "UTF-8");

echo "Olá, " . $nome;