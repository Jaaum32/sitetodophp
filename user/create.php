<?php
require_once "../db/connection.inc.php";
require_once "user.dao.php";

$userDao = new UserDAO($pdo);

$json = file_get_contents('php://input');

$user = json_decode($json);

$responseBody = '';

try {
    $user = $userDao->insert($user);

    $responseBody = json_encode($user);
}catch(Exception $e){
    http_response_code(400);
    $responseBody = '{ "message": "não inseriu ;-;. Erro:: Código: "' . $e->getCode() . '. Mensagem: ' . $e->getMessage() . '}';
}

header('Content-Type: application/json');

print_r($responseBody);
?>