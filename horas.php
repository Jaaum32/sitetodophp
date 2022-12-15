<?php 
    $data_inicio = new DateTime("2022-12-15 12:00:00");
    $data_fim = new DateTime("2022-12-15 12:00:01");

    // Resgata diferença entre as datas
    $dateInterval = $data_inicio->diff($data_fim);
    echo $dateInterval->days .'<br>';
    echo $dateInterval->h;

    if($data_inicio < $data_fim){
        echo "inicio <<";
    }else{
        echo "fim <<";
    }

    //365
 ?>