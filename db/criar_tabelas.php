<?php
include_once "connection.inc.php";

$sqls = array();

array_push(
    $sqls,
    "CREATE TABLE IF NOT EXISTS tb_usuario (
    id int NOT NULL AUTO_INCREMENT,
    nome varchar(100) NOT NULL,
    nascimento date,
    email varchar(100) NOT NULL,
    senha varchar(20) NOT NULL default '',
    login varchar(20),
    PRIMARY KEY  (id),
    UNIQUE(email)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
);

array_push(
  $sqls,
  "CREATE TABLE IF NOT EXISTS tb_tarefa (
  id int NOT NULL AUTO_INCREMENT,
  id_usuario int,
  titulo varchar(20),
  descricao varchar(60),
  concluido bit NOT NULL,
  data DATETIME,
  PRIMARY KEY  (id),
  foreign key(id_usuario) references tb_usuario(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
);

foreach ($sqls as $sql) {
    try {
      if ($pdo->prepare($sql)->execute()) {
        printf("<b>Table created successfully.</b><br />");
        printf("<pre>$sql</pre>");
      }
    }
    catch (Exception $e) {
      printf("<b>Could not create table.</b><br />");
      printf($e);
    }

    echo "<hr/>";
}

exit;


?>