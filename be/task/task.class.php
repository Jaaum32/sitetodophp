<?php

class Task{
    function __construct($titulo, $descricao, $data, $concluido, $id_usuario){
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->data = $data;
        $this->concluido = $concluido;
        $this->id_usuario = $id_usuario;
    }
}