<?php
class TaskDao
{
    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function insert($task)
    {
        $stmt = $this->pdo->prepare("INSERT INTO tb_tarefa (titulo, descricao, data, concluido, id_usuario) VALUES (:titulo, :descricao, :data, :concluido, :id_usuario)");
        $stmt->bindValue(':titulo', $task->titulo);
        $stmt->bindValue(':descricao', $task->descricao);
        $stmt->bindValue(':data', $task->data);
        $stmt->bindValue(':concluido', $task->concluido);
        $stmt->bindValue(':id_usuario', $task->id_usuario);

        $stmt->execute();
        $task = clone $task;

        $task->id = $this->pdo->lastInsertId();

        return $task;
    }

    public function getAll($id_usuario)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tb_tarefa WHERE id_usuario = :id_usuario");
        $stmt->bindValue(':id_usuario', $id_usuario);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function get($id_task)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tb_tarefa WHERE id=:id_task");
        $stmt->bindValue(':id_task', $id_task);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function delete($id_task)
    {
        $stmt = $this->pdo->prepare("DELETE FROM tb_tarefa WHERE id=:id_task");
        $stmt->bindValue(':id_task', $id_task);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function update($id, $task){
        $stmt = $this->pdo->prepare("UPDATE tb_tarefa 
        SET
            titulo = :titulo,
            descricao = :descricao,
            data = :data,
            concluido = :concluido,
            id_usuario = :id_usuario
        WHERE id=:id");

        $dados = [
            'id' => $id,
            'titulo' => $task->titulo,
            'descricao' => $task->descricao,
            'data' => $task->data,
            'concluido' => $task->concluido,
            'id_usuario' => $task->id_usuario
        ];

        return $stmt->execute($dados);
        
    }
}
?>