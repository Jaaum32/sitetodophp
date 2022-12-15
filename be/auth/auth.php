<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

/**
 * Este script PHP é um recurso de autenticação. Serve para gerar o token do usuário.
 * 
 * O objetivo é receber um JSON, no corpo da requisição HTTP, contendo o login e a senha
 * do usuário.
 * 
 * Na sequência, o login e a senha repassados devem ser avaliados (aqui é feito de maneira fictícia).
 * Se estiverem corretos, então o token é gerado e entregue ao cliente. Caso contrário, 
 * uma mensagem informativa é enviada.
 */

// Inclusão de arquivos
require_once "../db/connection.inc.php";
require_once "config.inc.php";
require_once "util/jwtutil.class.php";
require_once "../user/user.dao.php";

$userDao = new UserDAO($pdo);

// Obter o conteúdo do corpo da requisição
$json = file_get_contents('php://input');

// Transforma o JSON em um Objeto PHP
$credentials = json_decode($json);

$responseBody = 'deu certo?'; // Variável para armazenar a resposta para o cliente

/**
 * Se o usuário for válido, então gera o token.
 * 
 * Validação fictícia: o usuário deve ser igual a "admin" e a senha igual a "1234".
 */

$user = $userDao->getByEmail(@$credentials->email);

if (empty($user)) {
    http_response_code(400);
    $responseBody = '{ "message": "Este email não esta cadastrado"}';
} else {
    if ($user->senha == $credentials->senha) {
        // Array de dados para ser carregado no token (aceita qualquer atributo e valor).
        $payload = [
            "sub" => $user->id,
            "nome" => $user->nome
        ];

        // Gerar o token (codificar), usando a classe disponível no arquivo "jwtutil.class.php"
        $token = JwtUtil::encode($payload, JWT_SECRET_KEY);

        // Gerando a mensagem de resposta para o cliente: um JSON contendo o token.
        //$responseBody = "{ \"token\": \"$token\" }";
        $responseBody = '{"token": "'.$token.'"}';
    } else {
        http_response_code(400);
        $responseBody = '{ "message": "Senha incorreta"}';
    }
}

// Defique que o conteúdo da resposta será um JSON (application/JSON)
header('Content-Type: application/json');

// Exibe a resposta
echo ($responseBody);