<?php

class UserDAO
{
    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        //Prepare our select statement.
        $stmt = $this->pdo->prepare("SELECT * FROM tb_usuario");
        $stmt->execute();

        // Retorna um array de objetos
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function getByEmail($email)
    {
        //Prepare our select statement.
        $stmt = $this->pdo->prepare("SELECT id, senha FROM tb_usuario WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        // Retorna um array de objetos
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