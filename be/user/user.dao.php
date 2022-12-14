<?php

class UserDAO
{
    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tb_usuario");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function getByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT id, senha, nome FROM tb_usuario WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        return $stmt->fetchObject();
    }

    public function insert($user)
    {
        $stmt = $this->pdo->prepare("INSERT INTO tb_usuario (nome, nascimento, email, senha) VALUES (:nome, :nascimento, :email, :senha)");
        $stmt->bindValue(':nome', @$user->nome);
        $stmt->bindValue(':nascimento', @$user->nascimento);
        $stmt->bindValue(':email', @$user->email);
        $stmt->bindValue(':senha', @$user->senha);

        $stmt->execute();
        $user = clone $user;

        $user->id = $this->pdo->lastInsertId();

        return $user;
    }

}