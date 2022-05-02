<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");

include_once "conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$response = "";

if ($id) {
    $query_produto = "DELETE FROM produtos WHERE id=:id LIMIT 1";
    $delete_produto = $conn->prepare($query_produto);
    $delete_produto->bindParam(':id', $id);

    $delete_produto->execute();

    if ($delete_produto->rowCount()) {
        $response = [
            "erro" => false,
            "Mensagem" => "Produto apagado com sucesso!"
        ];
    } else {
        $response = [
            "erro" => true,
            "Mensagem" => "Produto não apagado com sucesso!"
        ];
    }
} else {
    $response = [
        "erro" => true,
        "Mensagem" => "Escolha um ID!"
    ];
}

http_response_code(200);
echo json_encode($response);
