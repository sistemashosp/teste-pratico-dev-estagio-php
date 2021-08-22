<?php
//echo "Seu código aqui"; 
    function LerAquivo(){
        //variaveis uteis

        //abrir e testar csv
        if(!$csv = fopen('pacientes.csv', 'r')){
            echo 'arquivo nao encontrado';
        }
        else{
            //parametro
            $linha0 = fgetcsv($csv, 0, ',', '"');
            //fazer leitura             
            //while (!feof($csv)) {
            for($i=0; $i <= 100; $i++) {   
                $linha = fgetcsv($csv, 0, ',', '"');
                
                $registro = array_combine($linha0, $linha);
                
                //exibir
                echo "<table border = '1px'>";
                echo "<tr>";
                echo "<td width='75'>";
                echo ($registro['nome']);
                echo "<td width='75'>";
                echo ($registro['sobrenome']);
                echo "</td>";
                echo "<td width='100' >";
                echo ($registro['cpf']);
                echo "</td>";
                echo "<td width='300' >";
                echo filter_var($registro['email'], FILTER_VALIDATE_EMAIL);
                echo "</td>";
                echo "<td width='100'>";
                echo date('d/m/Y', strtotime($registro['datanascimento']));
                echo "</td>";
                echo "<td width='50'>";
                echo $registro['tiposanguineo'];
                echo "</td>";
                echo "<td width='50'>";
                echo $registro['genero'];
                echo "</td>";
                echo "<td width='350'>";
                echo ($registro['endereco']);
                echo "</td>";
                echo "<td width='200' >";
                echo ($registro['cidade']);
                echo "</td>";
                echo "<td width='50' >";
                echo ($registro['estado']);
                echo "</td>";
                echo "<td width='100'>";
                echo $registro['cep'];
                echo "</td>";
                echo "</tr>";
                echo "</table>";
            }

        //fechar aquivo
        }
    }

    LerAquivo()
?>