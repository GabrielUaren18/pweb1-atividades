<?php

$visitas = isset($_COOKIE["visitas"]) ? (int) $_COOKIE["visitas"] : 0;

$visitas++;

setcookie("visitas", (string) $visitas, time() + 3600, "/q10-cookies/");

echo "Você visitou esta página " . $visitas . " vez(es).";