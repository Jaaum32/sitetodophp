<?php

/**
 * Este script PHP serve para ser incluido como medida
 * de segurança nos recursos da API.
 * 
 * O que o script faz?
 *  1) Extrai o token do cabeçalho da requisição.
 *  2) Verifica se o token foi passado no caçbeçalho da
 *     requisição HTTP.
 *  3) Verifica se o token é válido.
 */

// Importação de arquivos
require_once "config.inc.php"; 
require_once "util/jwtutil.class.php";

/**
 * Passo 1) Obtendo o token do cabeçalho da requisição.
 * O token é enviado pelo cliente como o parâmetro
 * authorization.
 */
$token = @getallheaders()['authorization'];

$responseBody = ''; // Variável que armazena uma resposta para o cliente

/**
 * Passo 2) Verificar se o token foi realmente enviado pelo cliente.
 * Caso o tokan não foi passado, então uma resposta de "Não autorizado"
 * será enviado para o cliente.
 */
if (!isset($token)) {
    // Muda o código de resposta HTTP para 'Unauthorized'
    http_response_code(401);
    $responseBody = '{ "message": "Sem token" }';
} else {
    /**
     * Passo 3) O token é decodificado. Caso dê problema na
     * decodificação do token, uma exceção será lançada.
     */
    try {
        $decoded = JwtUtil::decode($token, JWT_SECRET_KEY);
    } catch(Exception $ex) {
        // Gerando a resposta para o cliente, caso o token não
        // seja decodificado corretamente, ou seja, o token é inválido.
        http_response_code(401);
        $responseBody = '{ "message": "Token inválido" }';
    }
}

/**
 * Caso exista uma resposta (variável $responseBody tem algum valor),
 * então uma resposta é mostrada para o cliente e a execução do script
 * PHP será encerrada.
 */
if ($responseBody) {
    // Define que o conteúdo da resposta será um JSON (application/JSON)
    header('Content-Type: application/json');

    // Exibe a resposta
    print_r($responseBody);

    exit; // Encerra o script
}