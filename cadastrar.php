<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");
header("Access-Control-Allow-headers: *");
header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE");

include "conexao.php";

$response_json = file_get_contents("php://input");
$dados = json_decode($response_json, true);

if ($dados) {
    $query_produto = "INSERT INTO produtos (titulo, descricao) VALUES (:titulo, :descricao)";
    $cad_produto = $conn->prepare($query_produto);

    $cad_produto->bindParam(':titulo', $dados['produto']['titulo']);
    $cad_produto->bindParam(':descricao', $dados['produto']['descricao']);

    $cad_produto->execute();
}

if ($cad_produto->rowCount()) {
    $response = [
        "erro" => false,
        "mensagem" => "Produto cadastrado com sucesso!"
    ];
} else {
    $response = [
        "erro" => true,
        "mensagem" => "Produto não cadastrado com sucesso!"
    ];
}

http_response_code(200);
echo json_encode($response);
