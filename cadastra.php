<?php header('Content-Type: text/html; charset=utf-8');

require_once 'models/Paciente.php';
$arquivo =  file('pacientes.csv');

$lista_pacientes = array();
for($i = 1; $i < sizeof($arquivo); $i++){
    $lista_tmp = explode(",", utf8_encode($arquivo[$i]));


    array_push($lista_pacientes, new Paciente($lista_tmp[0], $lista_tmp[1], $lista_tmp[2],$lista_tmp[3],$lista_tmp[4],$lista_tmp[5],
                                                    $lista_tmp[6], $lista_tmp[7], $lista_tmp[8], $lista_tmp[9], $lista_tmp[10], $lista_tmp[11]));
}

$listax = array();
foreach ($lista_pacientes as $paciente){
    array_push($listax, $paciente->toString());
}
print_r($listax);

