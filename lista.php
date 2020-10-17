<?php
 
function validaCPF($cpf){
 
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
 
    if (strlen($cpf) != 11) {
        return 0;
    }
 
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
 
function LerPacientesCSV(){
 
    $delimitador = ',';
    $cerca = '"';
 
    // Abrir arquivo para leitura
    $f = fopen('pacientes.csv', 'r');
    if ($f) {
        
        $cabecalho = fgetcsv($f, 0, $delimitador, $cerca);
 
        while (!feof($f)) {
 
            $linha = fgetcsv($f, 0, $delimitador, $cerca);
            if (!$linha) {
                continue;
            }
 
            $registro = array_combine($cabecalho, $linha);
            
            $arr_tipo = ['A+','B+','O+','AB+','A-','O-','B-','AB-'];
 
            if(in_array($registro['tiposanguineo'],$arr_tipo)){
                $tipo_sanguineo = $registro['tiposanguineo'];
            }else{
                $tipo_sanguineo = 0;
            }
 
            echo "<table>";
 
            echo "<tr>";
            echo "<td width='100' style='border: 1px solid black'>";
            echo utf8_encode($registro['nome']);
            echo " ";
            echo utf8_encode($registro['sobrenome']);
            echo "</td>";
            echo "<td width='100'  style='border: 1px solid black'>";
            echo validaCPF($registro['cpf']);
            echo "</td>";
            echo "<td width='300' style='border: 1px solid black'>";
            echo filter_var($registro['email'], FILTER_VALIDATE_EMAIL);
            echo "</td>";
            echo "<td width='100' style='border: 1px solid black'>";
            echo date('d/m/Y', strtotime($registro['datanascimento']));
            echo "</td>";
            echo "<td width='50' style='border: 1px solid black'>";
            echo $tipo_sanguineo;
            echo "</td>";
            echo "<td width='50' style='border: 1px solid black'>";
            echo $registro['genero'];
            echo "</td>";
            echo "<td width='300' style='border: 1px solid black'>";
            echo utf8_encode($registro['endereco']);
            echo "</td>";
            echo "<td width='100' style='border: 1px solid black'>";
            echo utf8_encode($registro['cidade']);
            echo "</td>";
            echo "<td width='50' style='border: 1px solid black'>";
            echo utf8_encode($registro['estado']);
            echo "</td>";
            echo "<td width='100' style='border: 1px solid black'>";
            echo $registro['cep'];
            echo "</td>";
            echo "</tr>";
            echo "</table>";
        }
 
        fclose($f);
    }
 
}
 
LerPacientesCSV();