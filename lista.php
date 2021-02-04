<?php

function valida_Cpf($cpf){
    if (strlen($cpf) != 11) {
        return false;
    }

    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    #melhorar para eu entender
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

function valida_email($email) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    } else {
        return false;
    }
}

function valida_data($data) {
    if((strlen($data) < 8) || (strlen($data) > 11)) {
        return false;
    }

    if(!strpos($data, "/")) {
        return false;
    }

    $partes = explode('/', $data );

    $mes = $partes[0];
    $dia = $partes[1];
    $ano = $partes[2];

    if(strlen($ano) < 4) {
        return false;
    }

    if(!checkdate($mes, $dia, $ano)) {
        return false;
    }
    return true;
}

$delimitador = ',';
$cerca = '"';

$f = fopen('pacientes.csv', 'r');

if ($f) {
    $th = fgetcsv($f, 0, $delimitador, $cerca);
    $table =  '<table>';
    $table .= '<thead>';
    $table .= '<tr>';

    for ($i = 0; $i < count($th); $i++) {
        $table .= '<th>'.$th[$i].'</th>';
    }

    $table .= '</tr>';
    $table .= '</thead>';
    $table .= '<tbody>';

    while(!feof($f)) {
        $linha = fgetcsv($f, 0, $delimitador, $cerca);

        #validar
        if(!valida_Cpf($linha[10])) {
            break;
        }

        if(!valida_email($linha[2])) {
            break;
        }

        if(!valida_data($linha[3])){
            break;
        }

        $table .= '<tr>';
        for ($i = 0; $i < count($linha); $i++) {
            $table .= '<td>'.$linha[$i].'</td>';
        }
        $table .= '</tr>';
        if (!$linha) {
            continue;
        }
    }
    $table .= '</tbody>';
    $table .= '</table>';

    fclose($f);
}

echo $table;