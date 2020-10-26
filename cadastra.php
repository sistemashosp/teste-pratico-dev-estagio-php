<?php

// your code here
function cadastra(){
  global $paginac;
  global $cadastrosCsv;
  global $cabecalho;  
  $cadastrosCsv= fopen('pacientes.csv','r');
  $cabecalho = fgetcsv($GLOBALS['cadastrosCsv'],1000,','); 
  $paginac=0;

  function showTablePacients($listinha,$i){    
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
                
  }

  function tryShowTablePacients($listinha,$i){
    if((($data=strtotime($listinha[$i]['datanascimento']))>0)){
      showTablePacients($listinha,$i);
    }
  }

  function showHeaders(){
    $listinha = array();       
    $listinha[] = array_combine($GLOBALS['cabecalho'],$GLOBALS['cabecalho']);  
    echo '<strong>'   ;
      showTablePacients($listinha,0);
    echo '<strong/>'   ;
  }

  function showPatients(){
      
          $listinha= array();
      
          $dados = fgetcsv($GLOBALS['cadastrosCsv'],1000,','); 
          
          $paginac=$GLOBALS['paginac'];
          while(($dados)&&($paginac<5)){      
              
              $listinha[] = array_combine($GLOBALS['cabecalho'],$dados);    
              $dados = fgetcsv($GLOBALS['cadastrosCsv'],1000,','); 

              showTablePacients($listinha,$paginac);

              $paginac++;
        
          }
          

  }
  
  echo "<div/>";
  echo "<table>";
    showHeaders();
    showPatients();
  echo "</table>";
  
    echo "why";



    }
  function insertJavascript(){
    $Jscript = "
    <script type='text/javascript'>
    
      
    function botaozao(){
        
      document
      .querySelector('body div')
      .appendChild(document
          .createElement('button')
          
          )
          .addEventListener('click', function(){
            alert('wrath');
              eval('<?php showPatients() ?>');
            alert('wrath');
          }         
    );
    document
      .querySelector('body div button')
      .innerHTML='s';
      }

  window.addEventListener('load',function(ev){
  setTimeout(botaozao,1000);
  
  });
  
  
    

    
    </script>
    ";
    echo $Jscript;

  }  
    

  function storedQuantity($listinha=array()){
    $i=0;
        foreach($listinha as &$dado){
            $i=$i+1;        
        }
        echo "<br/>você tem $i cadasdtros";

    }



insertJavascript();
cadastra();

?>
