<?php

if (isset($_COOKIE["usuario_logado"])) {
    echo "Bem-vindo ao dashboard!";
} else {
    echo "Você não está logado.";
}
