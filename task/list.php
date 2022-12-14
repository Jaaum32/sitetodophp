<?php
require_once "../db/connection.inc.php";
require_once "task.dao.php";
require_once "../auth/validate-jwt.inc.php";

$taskDao = new TaskDao($pdo);

$responseBody = '';

$responseBody = $decoded["sub"];

if(@$_REQUEST['id']){
    if($res = $taskDao->get(@$_REQUEST['id'])){
        $responseBody = json_encode($res);
    }else{
        http_response_code(404);
        $responseBody = '{ "message": "Essa task não existe"}';
    }
}else{
    $responseBody = json_encode(
        $taskDao->getAll(@$decoded["sub"])
    );
}

header('Content-Type: application/json');


echo $responseBody;
?>