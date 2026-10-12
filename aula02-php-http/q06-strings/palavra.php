<?php

/* Cod do Renato
$palavra = $_GET['palavra'] ?? "Ceara";

echo "<p>Palavra: $palavra</p>";
echo "<p>strlen: " . strlen($palavra) . "</p>";

*/

$palavra = $_GET['palavra'] ?? "Ceara";

echo "<p>Palavra: $palavra</p>";

echo "<p>strlen: " . strlen($palavra) . "</p>";

echo "<p>mb_strlen: " . mb_strlen($palavra, "UTF-8") . "</p>";

echo "<p>strtoupper: " . strtoupper($palavra) . "</p>";

echo "<p>mb_strtoupper: " . mb_strtoupper($palavra, "UTF-8") . "</p>";

if (mb_strlen($palavra, "UTF-8") <= 5) {
    echo "<p>Palavra curta</p>";
} else {
    echo "<p>Palavra longa</p>";
}
