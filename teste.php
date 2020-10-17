<?php
require_once "models/Validador.php";
require_once "models/Paciente.php";

$deubom = Validador::validateDate("25/12/1996");

if($deubom){
    echo "TRUE";
}else{
    echo "FALSE";
}


$pac = new Paciente("Joao", "Lucas", "jao@", "16/12/1996", "a","a",
    "a", "a","a", "a", "16872006706");