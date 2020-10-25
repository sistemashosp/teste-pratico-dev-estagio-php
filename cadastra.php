<?php

// your code here
function storeAllPatients(){
    $cadastrosCsv = fopen('pacientes.csv','r');
    $listinha = array();   

        $cabecalho = fgetcsv($cadastrosCsv,1000,',');    
        $dados = fgetcsv($cadastrosCsv,1000,',');
        $listinha[] = array_combine($cabecalho,$cabecalho);
    
        $i=0;
        echo "<table>";
        while(($dados)&&($i<5)){      
            
            $listinha[] = array_combine($cabecalho,$dados);    
            $dados = fgetcsv($cadastrosCsv,1000,',');     
            
                echo "<tr >";
                 
                    echo "<td style='padding:0.2em;'>";
                      echo $listinha[$i]['nome'];
                    echo "</td>";
                    echo "<td style='padding:0.2em;'>";
                      echo $listinha[$i]['sobrenome'];
                    echo "</td>";
                    echo "<td style='padding:0.2em;'>";

                      echo $listinha[$i]['cpf'];
                    echo "</td>";
                    echo "<td style='padding:0.2em;'>";
                      echo $listinha[$i]['email'];
                    echo "</td>";
                    echo "<td style='padding:0.2em;'>";
                      echo $listinha[$i]['datanascimento'];

                    echo "</td>";
                    echo "<td style='padding:0.2em;'>";
                      echo $listinha[$i]['genero'];
                    echo "</td>";
                    echo "<td style='padding:0.2em;'>";
                      echo $listinha[$i]['tiposanguineo'];
                    echo "</td>";

                    echo "<td style='padding:0.2em;'>";
                      echo $listinha[$i]['endereco'];
                    echo "</td>";
                    echo "<td style='padding:0.2em;'>";
                      echo $listinha[$i]['cidade'];
                    echo "</td>";

                    echo "<td style='padding:0.2em;'>";
                      echo $listinha[$i]['estado'];
                    echo "</td>";
                    echo "<td style='padding:0.2em;'>";
                      echo $listinha[$i]['cep'];
                    echo "</td>";
                  
                echo "</tr>";
            
            $i++;
       
        
        }
        echo "</table>";
        

}

function storedQuantity($listinha=array()){
    $i=0;
        foreach($listinha as &$dado){
            $i=$i+1;        
        }
        echo "<br/>você tem $i cadasdtros";

    }
  storeAllPatients();

?>
