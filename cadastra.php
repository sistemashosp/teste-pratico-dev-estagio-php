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
function storedQuantity($listinha=array()){
    $i=0;
        foreach($listinha as &$dado){
            $i=$i+1;        
        }
        echo "<br/>você tem $i cadasdtros";

    }
?>
