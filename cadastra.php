<?php

// your code here
$cadastrosCsv = fopen('pacientes.csv','r');
$listinha = array();   

    $cabecalho = fgetcsv($cadastrosCsv,1000,',');    
    $dados = fgetcsv($cadastrosCsv,1000,',');

?>
