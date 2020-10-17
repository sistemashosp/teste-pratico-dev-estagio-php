<?php

function getCSV($name) {
    $file = fopen($name, "r");
    $result = array();
    $i = 0;
    while (!feof($file)):
       if (substr(($result[$i] = fgets($file)), 0, 10) !== ';;;;;;;;') :
          $i++;
       endif;
    endwhile;
    fclose($file);
    return $result;
 }
 
 $foo = getCSV('pacientes.csv');

 $handle = fopen("pacientes.csv", "r");
 $row = 0;
     while ($line = fgetcsv($handle, 1000, ",")) {
	    if ($row++ == 0) {
		continue;
	}
	
	$people[] = [
		'nome' => $line[0],
		'sobrenome' => $line[1],
		'CPF' => $line[2],
      'Email' => $line[3]
      'Data de Nascimento' => $line[4]
      'Genero' => $line[5]
      'Tipo Sanguineo' => $line[6]
      'Endereco' => $line[7]
      'Cidade' => $line[8]
      'Estado' => $line[9]
      'CEP' => $line[10]
      $valido = true;

$campos = Array("<CPF 2=""></CPF>", "<Email 3=""></Email>", "Data de <Nascimento 4=""></Nascimento>");

foreach ($campos as $campo){
    if (empty($_POST[$campo])){
        echo "<p>Campo $campo em branco</p>";
        $valido = false;
    }
}

if ($valido){
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $datadenascimento = $_POST['Data de Nascimento']; 
    
}
	];
}
print_r($people);
fclose($handle);

 
 
?>