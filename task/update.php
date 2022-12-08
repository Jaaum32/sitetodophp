<?php
require_once "../db/connection.inc.php";
require_once "task.dao.php";

$taskDao = new TaskDao($pdo);

$json = file_get_contents('php://input');

$task = json_decode($json);

print_r($task);

$id = @$_REQUEST['id'];

$responseBody = '';


if(!$id){
    http_response_code(400);
    $responseBody = '{ "message": "id não informado"}';
}else{
    try {
        $taskDao->update($id,$task);
    
        $responseBody = json_encode($task);
    }catch(Exception $e){
        http_response_code(400);
        $responseBody = '{ "message": "Erro ao tentar executar esta ação. Erro:: Código: "' . $e->getCode() . '. Mensagem: ' . $e->getMessage() . '}';
    }
}


header('Content-Type: application/json');
print_r($responseBody);
?>