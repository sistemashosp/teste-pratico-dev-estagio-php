<?php
//echo "Seu código aqui"; 
  
    function ValidaCPF($cpf) {
        
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
        
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return 0;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return 0;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return 0;
            }
        }
        return $cpf;

    }
    //exibirTabela
    function ExibeTabela($registro){
        //exibir
        echo "<table border = '1px'>";
        echo "<tr>";
        echo "<td width='75'>";
        echo ($registro['nome']);
        echo "<td width='75'>";
        echo ($registro['sobrenome']);
        echo "</td>";
        echo "<td width='100' >";
        echo validaCPF($registro['cpf']);
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


    function LerArquivo($modo){
        //abrir e testar csv
        if(!$csv = fopen('pacientes.csv', 'r')){
            echo 'arquivo nao encontrado';
        }
        else{
            //
            $linha0 = fgetcsv($csv, 0, ',', '"');
            //fazer leitura  e exibir   
            
            switch($modo){
                case 0:
                    while (!feof($csv)) {
                        $linha = fgetcsv($csv, 0, ',', '"');
                        $registro = array_combine($linha0, $linha);
                        ExibeTabela($registro);
                    }
                    break;
                case 1:
                    for($i=0; $i <= 100; $i++) {   
                        $linha = fgetcsv($csv, 0, ',', '"');                        
                        $registro = array_combine($linha0, $linha);
                        ExibeTabela($registro);
                    }
                    break;            
            }
        }

        //fechar aquivo
        fclose($csv);

    }


    LerArquivo(0);

?>