<?php
require_once "../db/connection.inc.php";
require_once "task.dao.php";

$taskDao = new TaskDao($pdo);

$id = @$_REQUEST['id'];

$responseBody = '';


if(!$id){
    http_response_code(400);
    $responseBody = '{ "message": "id não informado"}';
}else{
    try {
        if($taskDao->delete($id) != 1){
            http_response_code(404);
            $responseBody = '{ "message": "Task não encontrado" }';
        }
    }catch(Exception $e){
        http_response_code(400);
        $responseBody = '{ "message": "Erro ao tentar executar esta ação. Erro:: Código: "' . $e->getCode() . '. Mensagem: ' . $e->getMessage() . '}';
    }
}


header('Content-Type: application/json');
print_r($responseBody);
?>