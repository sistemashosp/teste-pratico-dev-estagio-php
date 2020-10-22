<?php

// your code here
function storeAllPatients(){
    $cadastrosCsv = fopen('pacientes.csv','r');
    $listinha = array();   

        $cabecalho = fgetcsv($cadastrosCsv,1000,',');    
        $dados = fgetcsv($cadastrosCsv,1000,',');
        $listinha[] = array_combine($cabecalho,$cabecalho);
        while($dados){      
            $listinha[] = array_combine($cabecalho,$dados);    
            $dados = fgetcsv($cadastrosCsv,1000,',');      
        break;  
        }

}
?>
