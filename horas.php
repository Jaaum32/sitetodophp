<?php 
    $data_inicio = new DateTime("2022-12-15 14:51:00");    
    $data_fim = new DateTime("2022-12-16 02:30:01");
    $dateInterval = $data_inicio->diff($data_fim);

echo $data_inicio->format("d");

    //echo $dateInterval->days .'<br>';
    //echo $dateInterval->h;

    //365
 ?>