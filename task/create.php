<?php
require_once "../db/connection.inc.php";
require_once "task.dao.php";

$taskDao = new TaskDao($pdo);

$json = file_get_contents('php://input');

$task = json_decode($json);

$responseBody = '';

try {
    $task = $taskDao->insert($task);

    $responseBody = json_encode($task);
}catch(Exception $e){
    http_response_code(400);
    $responseBody = '{ "message": "Esta ação não pode ser executada. Erro:: Código: "' . $e->getCode() . '. Mensagem: ' . $e->getMessage() . '}';
}

header('Content-Type: application/json');

print_r($responseBody);
?>