<?php header('Content-Type: text/html; charset=utf-8');

require_once 'models/Paciente.php';

$nome_arquivo = 'pacientes.csv';
if (!file_exists($nome_arquivo)){
    echo "<h1 style='text-align: center; color: red'>Arquivo $nome_arquivo não encontrado, revise seu diretório raiz</h1>";
    exit();
}

$arquivo = file($nome_arquivo);
$lista_pacientes = array();
$emails_invalidos = 0;
$datas_invalidas = 0;
$cpfs_invalidos = 0;
$erro_arquivo = 0;

for ($i = 1;$i < sizeof($arquivo);$i++){
    $paciente_atual = explode(",", utf8_encode($arquivo[$i]));
    try{
        $nome = (str_ireplace('"', "", $paciente_atual[0]));
        $sobrenome = (str_ireplace('"', "", $paciente_atual[1]));
        $email = (str_ireplace('"', "", $paciente_atual[2]));
        $data_nas = new DateTime(str_ireplace('"', "", $paciente_atual[3]));
        $data_formatada = date_format($data_nas, 'd/m/Y');
        $genero = (str_ireplace('"', "", $paciente_atual[4]));
        $fator_rh = (str_ireplace('"', "", $paciente_atual[5]));
        $endereco = (str_ireplace('"', "", $paciente_atual[6]));
        $cidade = (str_ireplace('"', "", $paciente_atual[7]));
        $estado = (str_ireplace('"', "", $paciente_atual[8]));
        $cep = (str_ireplace('"', "", $paciente_atual[9]));
        $cpf = (str_ireplace('"', "", $paciente_atual[10]));
        array_push($lista_pacientes, new Paciente($nome, $sobrenome, $email, $data_formatada, $genero,
                                                        $fator_rh, $endereco, $cidade, $estado, $cep, $cpf));
    }
    catch(EmailInvalidoException $ex){
        $emails_invalidos++;
    }
    catch(NascimentoInvalidoException $ex){
        $datas_invalidas++;
    }
    catch(CpfInvalidoException $ex){
        $cpfs_invalidos++;
    }catch (Exception $ex){
        $erro_arquivo++;
    }

}

echo "<h1 style='color: #2197f4; text-align: center'>Relatório de pacientes cadastrados</h1>";
if ($emails_invalidos > 0){
    echo "<p style='text-align: center; color: red'>$emails_invalidos emails inválidos tentaram ser cadastrados.</p>";
}
if ($datas_invalidas > 0){
    echo "<p style='text-align: center; color: red'>$datas_invalidas datas inválidos tentaram ser cadastrados.</p>";
}
if ($cpfs_invalidos > 0){
    echo "<p style='text-align: center; color: red'>$cpfs_invalidos cpf inválidos tentaram ser cadastrados.</p>";
}
if ($erro_arquivo > 0){
    echo "<p style='text-align: center; color: red'>$cpfs_invalidos linhas de sua planilha podem ter causado problemas.</p>";
}
if ($emails_invalidos > 0 || $datas_invalidas > 0 || $cpfs_invalidos > 0 || $erro_arquivo > 0){
    echo "<p style='text-align: center; color: red'>A sua planilha deve estar de acordo 
          com os campos abaixo para que o paciente seja cadastrado revise seu arquivo CSV</p>";
}

echo "<div style='width: 960px; margin: 0 auto'>";
echo "<table style='border: #2197f4 3px solid' cellspacing='3px'>";
echo "<tr style='text-align: center; background: #ffa726;'>";
echo "<td style='text-align: center; background: #ffa726'>" . "Nome" . "</td>";
echo "<td style='text-align: center; background: #ffa726'>" . "Sobrenome" . "</td>";
echo "<td style='text-align: center; background: #ffa726'>" . "Email" . "</td>";
echo "<td style='text-align: center; background: #ffa726'>" . "Data de nascimento" . "</td>";
echo "<td style='text-align: center; background: #ffa726'>" . "Genero" . "</td>";
echo "<td style='text-align: center; background: #ffa726'>" . "Fator RH" . "</td>";
echo "<td style='text-align: center; background: #ffa726'>" . "Endereço" . "</td>";
echo "<td style='text-align: center; background: #ffa726'>" . "Cidade" . "</td>";
echo "<td style='text-align: center; background: #ffa726'>" . "Estado" . "</td>";
echo "<td style='text-align: center; background: #ffa726' >" . "Cep" . "</td>";
echo "<td style='text-align: center; background: #ffa726'>" . "CPF" . "</td>";
echo "</tr>";

$coluna = 0;
foreach ($lista_pacientes as $paciente){
    if ($coluna % 2 == 0){
        echo "<tr>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getNome() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getSobrenome() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getEmail() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getDatanascimento() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getGenero() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getFatorrh() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getEndereco() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getCidade() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getEstado() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getCep() . "</td>";
        echo "<td style='text-align: center; background: #2197f4'>" . $paciente->getCpf() . "</td>";
        echo "</tr>";
    }
    else{
        echo "<tr>";
        echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getNome() . "</td>";
        echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getSobrenome() . "</td>";
        echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getEmail() . "</td>";
        echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getDatanascimento() . "</td>";
        echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getGenero() . "</td>";
        echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getFatorrh() . "</td>";
        echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getEndereco() . "</td>";
        echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getCidade() . "</td>";
        echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getEstado() . "</td>";
        echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getCep() . "</td>";
        echo "<td style='text-align: center; background: #ffa726'>" . $paciente->getCpf() . "</td>";
        echo "</tr>";
    }

    $coluna++;
}
echo "</table>";
echo "</div>";

