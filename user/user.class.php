<?php
class User
{
    function __construct($nome, $nascimento, $email, $login, $senha)
    {
        $this->nome = $nome;
        $this->nascimento = $nascimento;
        $this->email = $email;
        $this->login = $login;
        $this->senha = $senha;
    }
}