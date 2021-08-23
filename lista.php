<style>
    table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid black;
        text-align: center;
        table-layout: fixed;
    } 
    td, th {
        border: 1px solid black;
        overflow: hidden;
        word-break: break-all;
    }
</style>



<?php

    //Desafio feito usando o "XAMPP" server para criar um servidor e rodar o código php
    //As seguintes lógicas foram aplicadas:
        //-Abertura do arquivo com verificação se o arquivo existe
        //-Se a abertura do arquivo estiver ok e o "fgetcsv" estiver rodando ele começa o laço de repetição abrindo a tabela
        //-Faz a checagem se estiver no index "2" do array para verificar se o email digitado está correto, caso não esteja ele deixa o campo em branco
        //-Faz a checagem se estiver no index "3" do array para verificar se a data digitada está correta, levando em consideração que utilizei o padrão 
        // brasileiro de datas "dd/mm/aa" porém o arquivo estava em padrão norte americano "mm/dd/aa" então adicionei a possibilidade de inverter as datas também
        //-Faz a checagem se estiver no index "3" do array para verificar se o cpf digitado está correto, utilizando a função "validaCPF()" declarada no início do código
        //-Por último ele faz a checagem para ignorar a primeira linha da tabela para inserir apenas os dados

    function validaCPF($cpf) {

        // Verifica se um número foi informado
        if(empty($cpf)) {
            return false;
        }

        // Elimina possivel masc
        // Verifica se o numero de digitos informados é igual a 11 
        else if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cpf == '00000000000' || 
            $cpf == '11111111111' || 
            $cpf == '22222222222' || 
            $cpf == '33333333333' || 
            $cpf == '44444444444' || 
            $cpf == '55555555555' || 
            $cpf == '66666666666' || 
            $cpf == '77777777777' || 
            $cpf == '88888888888' || 
            $cpf == '99999999999') {
            return false;
        // Calcula os digitos verificadores para verificar se o
        // CPF é válido
        } 
        
        else {   
            
            for ($t = 9; $t < 11; $t++) {
                
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }
            return true;
        }
    }

    //pattern para verificação se email digitado é válido
    $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

    if (($handle = fopen('pacientes.csv', 'r')) !== FALSE) { // Faz a verificação para saber se o arquivo existe
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Faz a verificação se a abertura do arquivo está correto
            
            echo "<table>"; 
            echo "<tr> \n";

            //Laço de repetição que verifica se o email digitado está dento do $pattern declarado anteriormente
            for ($i=0; $i <= 11; $i++) { 
                if ($i == 2) {
                    $emailaddress = $data[2];
                    
                    if (preg_match($pattern, $emailaddress) === 0) {
                        $data[2] = ' ';
                    }
                }
                //verifica se o laço entrou no index 3 do array
                if ($i == 3){
                    // fatia a string $data[3] em pedaços, usando / como referência
                    $mdy = explode("/", $data[3]); 
                    //organiza o dia mes e ano preparando para o checkdate() verificar se a data é valida
                    if ($data[0] !== "nome"){
                        $m = intval($mdy[0]);
                        $d = intval($mdy[1]);
                        $y = intval($mdy[2]);

                        //inverte a posição do dia e do mês para ficar no padrão brasileiro de datas
                        $coringa = $m;
                        $m = $d;
                        $d = $coringa;

                        //faz a verificação se a data é válida
                        $res = checkdate($m,$d,$y);
                        //se o checkdate() retornar "0"(falso) ele altera o valor do array para imprimir em branco na tabela.
                        if ($res == 0){
                            $data[3] = '';
                        }
                    }                   
                }
                //faz a verificação se o laço está no index 10 do array, transforma o valor de string para inteiro para verificar se o cpf é válido
                if($i == 10){
                    $ncpf = intval($data[10]);
                    $valida = validaCPF($ncpf);

                    if ($valida == false) {
                        $data[10] = '';
                    }
                }
                //pula a primeira linha do arquivo .csv
                if ($data[0] !== "nome"){
                    //organize o echo para corrigir a acentuação do código
                    echo utf8_encode("<td>$data[$i]</td>");
                }            
            }
        echo "</tr>";
    }
    echo "</table>";

    }
    fclose($handle);

?>