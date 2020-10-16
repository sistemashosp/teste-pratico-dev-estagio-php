<?php header('Content-Type: text/html; charset=utf-8');

require_once 'models/Paciente.php';
$arquivo =  file('pacientes.csv');

$lista_pacientes = array();
$emails_invalidos = 0;
$datas_invalidas = 0;
$cpf_invalidos = 0;

for($i = 1; $i < sizeof($arquivo); $i++){
    $lista_tmp = explode(",", utf8_encode($arquivo[$i]));
    try {
            $data = new DateTime(str_ireplace('"', "", $lista_tmp[3]));
            array_push($lista_pacientes, new Paciente(str_ireplace('"', "", $lista_tmp[0]),
            str_ireplace('"', "", $lista_tmp[1]), str_ireplace('"', "", $lista_tmp[2]),
            date_format($data, 'd/m/Y'), str_ireplace('"', "", $lista_tmp[4]),
            str_ireplace('"', "", $lista_tmp[5]), str_ireplace('"', "", $lista_tmp[6]),
            str_ireplace('"', "", $lista_tmp[7]), str_ireplace('"', "", $lista_tmp[8]),
            str_ireplace('"', "", $lista_tmp[9]), str_ireplace('"', "", $lista_tmp[10]),
            str_ireplace('"', "", $lista_tmp[11])));
    }catch (EmailInvalidoException $ex){
        $emails_invalidos++;
    }
    catch (NascimentoInvalidoException $ex){
        $datas_invalidas++;
    }catch (CpfInvalidoException $ex){
        $cpf_invalidos++;
    } catch (Exception $e) {
    }
}

echo "<h1 style='color: #2197f4; text-align: center'>Relatório de pacientes cadastrados</h1>";
if ($emails_invalidos > 0){
    echo "<p style='text-align: center; color: red'>$emails_invalidos emails inválido(s) tentaram ser cadastrados, revise seu arquivo CSV</p>";
}
if($datas_invalidas > 0){
    echo "<p style='text-align: center; color: red'>$datas_invalidas datas inválido(s) tentaram ser cadastrados, revise seu arquivo CSV</p>";

}
if($cpf_invalidos > 0){
    echo "<p style='text-align: center; color: red'>$cpf_invalidos cpf inválido(s) tentaram ser cadastrados, revise seu arquivo CSV</p>";
}


echo "<div style='width: 960px; margin: 0 auto'>";
echo "<table style='border: #2197f4 3px solid' cellspacing='3px'>";
echo "<tr style='text-align: center; background: #ffa726;'>";
echo "<td style='text-align: center; background: #ffa726'>". "Nome" . "</td>";
echo "<td style='text-align: center; background: #ffa726'>". "Sobrenome" . "</td>";
echo "<td style='text-align: center; background: #ffa726'>". "Email" . "</td>";
echo "<td style='text-align: center; background: #ffa726'>". "Data de nascimento" . "</td>";
echo "<td style='text-align: center; background: #ffa726'>". "Genero" . "</td>";
echo "<td style='text-align: center; background: #ffa726'>". "Fator RH" . "</td>";
echo "<td style='text-align: center; background: #ffa726'>". "Endereço" . "</td>";
echo "<td style='text-align: center; background: #ffa726'>". "Cidade" . "</td>";
echo "<td style='text-align: center; background: #ffa726'>". "Estado" . "</td>";
echo "<td style='text-align: center; background: #ffa726' >". "Cep" . "</td>";
echo "<td style='text-align: center; background: #ffa726'>". "CPF" . "</td>";
echo "<td style='text-align: center; background: #ffa726'>". "FrkPlano" . "</td>";
echo "</tr>";

$coluna = 0;
foreach ($lista_pacientes as $paciente){
     if($coluna % 2 == 0){
        echo "<tr>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getNome() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getSobrenome() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getEmail() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getNasc() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getGenro() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getSang() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getEndereco() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getCidade() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getEstado() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getCep() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getCpf() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getFrkPlano() . "</td>";
        echo "</tr>";
    }else{
        echo "<tr>";
         echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getNome() . "</td>";
         echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getSobrenome() . "</td>";
         echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getEmail() . "</td>";
         echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getNasc() . "</td>";
         echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getGenro() . "</td>";
         echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getSang() . "</td>";
         echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getEndereco() . "</td>";
         echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getCidade() . "</td>";
         echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getEstado() . "</td>";
         echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getCep() . "</td>";
         echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getCpf() . "</td>";
         echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getFrkPlano() . "</td>";
        echo "</tr>";
    }

    $coluna++;
}
echo "</table>";
echo "</div>";

