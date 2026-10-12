<?php

header("Content-Type: application/json; charset=utf-8");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    header("Allow: POST");

    echo json_encode(
        ["erro" => "Método não permitido"],
        JSON_UNESCAPED_UNICODE
    );

    exit;
}

http_response_code(200);

echo json_encode(
    ["mensagem" => "Requisição POST recebida com sucesso"],
    JSON_UNESCAPED_UNICODE
);