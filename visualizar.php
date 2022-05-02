<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UTF-8");

include_once "conexao.php";

//$id = 1;
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$response = "";

$query_produto = "SELECT id, titulo, descricao FROM produtos WHERE id=:id LIMIT 1";
$result_produto = $conn->prepare($query_produto);
$result_produto->bindParam(':id', $id);
$result_produto->execute();

if (($result_produto) and ($result_produto->rowCount() != 0)) {
    $row_produto = $result_produto->fetch(PDO::FETCH_ASSOC);
    extract($row_produto);
    $produto = [
        'id' => $id,
        'titulo' => $titulo,
        'descricao' => $descricao
    ];

    $response = [
        "erro" => false,
        "produto" => $produto
    ];
} else {
    $response = [
        "erro" => true,
        "mensagem" => "Produto não encontrado!"
    ];
}
http_response_code(200);
echo json_encode($response);
