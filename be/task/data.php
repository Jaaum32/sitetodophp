<?php
date_default_timezone_set("America/Sao_Paulo");

$json = file_get_contents('php://input');

$data = json_decode($json);

$responseBody = '';
$dataEvento = new DateTime($data->data);

$dataAtual = new DateTime();

if($dataEvento < $dataAtual){
    $responseBody = "Atrasado";
}else {
    $dateInterval = $dataAtual->diff($dataEvento);

    if($dateInterval->days == 0){
        if($dataAtual->format("d") != $dataEvento->format("d")){
            $responseBody = "Amanhã";
        }else{
            $responseBody = "Hoje"; 
        }
        
    }else{
        $responseBody = "Daqui a ".($dateInterval->d + 1)." dias"; 
    }
}

print_r($responseBody);
?>