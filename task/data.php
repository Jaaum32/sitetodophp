<?php
$responseBody = '';
$dataEvento = @$_REQUEST['data'];

if($dataEvento < date('y-m-d h:i:s')){
    $responseBody = "Atrasado";
}else {
    $dateInterval = $$dataEvento->diff(date('y-m-d h:i:s'));

    if($dateInterval->d == 0){
        $responseBody = "Hoje"; 
    }else if($dateInterval->d == 1){
        $responseBody = "Amanha"; 
    }else{
        $responseBody = "Daqui a ".$dateInterval->d." dias"; 
    }
}

print_r($responseBody);
?>