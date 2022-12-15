<?php
require_once "../db/connection.inc.php";
require_once "user.dao.php";

$userDao = new UserDAO($pdo);

$json = file_get_contents('php://input');

$user = json_decode($json);

//$responseBody;

try {
    $user = $userDao->insert($user);
    $responseBody = json_encode($user);
}catch(Exception $e){
    http_response_code(400);

    $responseBody = [
        "codigo"=> $e->getCode(),
        "message"=> $e->getMessage()
    ];
    //$responseBody = '{"codigo: ": ' . $e->getCode() . '" message": ' . $e->getMessage() . '}';
    $responseBody = json_encode($responseBody);
}

header('Content-Type: application/json');

echo($responseBody);
?>