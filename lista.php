<?php

$handle = fopen("pacientes.csv", "r");
$row = 0;

while ($linha = fgetcsv($handle, 1000, ",")) {
	if ($row++ == 0) {
		continue;
	}
	
	$paciente[] = [
		'nome' -> $linha[0],
		'sobrenome' -> $linha[1],
		'email' -> $linha[2],
        'datanascimento' -> $linha[3],
        'genero' -> $linha[4],
        'tiposanguineo' -> $linha[5],
        'endereco' -> $linha[6],
        'cidade' -> $linha[7],
        'estado' -> $linha[8],
        'cep' -> $linha[9],
        'cpf' -> $linha[10],
        'frkPlanoSaude' -> $linha[11]
	];
}

//echo '<pre>';
print_r($paciente);

fclose($handle);


?>