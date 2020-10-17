<?php
require_once "models/Validador.php";

class EmailInvalidoException extends Exception{

}
class NascimentoInvalidoException extends Exception{

}
class CpfInvalidoException extends Exception{

}

class Paciente
{

    private $nome;
    private $sobrenome;
    private $email;
    private $data_nascimento;
    private $genero;
    private $fator_rh;
    private $endereco;
    private $cidade;
    private $estado;
    private $cep;
    private $cpf;

    /**
     * Paciente constructor.
     * @param string $nome
     * @param string $sobrenome
     * @param string $email
     * @param string $data_nascimento
     * @param string $genero
     * @param string $fator_rh
     * @param string $endereco
     * @param string $cidade
     * @param string $estado
     * @param string $cep
     * @param string $cpf
     * @throws EmailInvalidoException
     * @throws CpfInvalidoException
     * @throws NascimentoInvalidoException
     * @throws Exception
     */
    public function __construct($nome, $sobrenome, $email, $data_nascimento, $genero, $fator_rh, $endereco, $cidade, $estado, $cep, $cpf)
    {
        $arrobas_email = substr_count($email,"@");
        if($arrobas_email > 1 || $arrobas_email == 0){
            throw new EmailInvalidoException("Email inválido");
        }
        if(strlen($cpf) != 11 || !Validador::validarCpf($cpf)){
            throw new CpfInvalidoException("CPF INVALIDO");
        }
        $ano_nascimento = intval(substr($data_nascimento, -4));
        if(!Validador::validateDate($data_nascimento) || $ano_nascimento > date('Y')){
            throw new NascimentoInvalidoException("Nascimento invalido");
        }
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->email = $email;
        $this->data_nascimento = $data_nascimento;
        $this->genero = $genero;
        $this->fator_rh = $fator_rh;
        $this->endereco = $endereco;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->cep = $cep;
        $this->cpf = $cpf;
    }

    /**
     * @return string
     */
    public function getNome(){
        return $this->nome;
    }

    /**
     * @return string
     */
    public function getSobrenome(){
        return $this->sobrenome;
    }

    /**
     * @return string
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * @return string
     */
    public function getDatanascimento(){
        return $this->data_nascimento;
    }

    /**
     * @return string
     */
    public function getGenero(){
        return $this->genero;
    }

    /**
     * @return string
     */
    public function getFatorrh(){
        return $this->fator_rh;
    }

    /**
     * @return string
     */
    public function getEndereco(){
        return $this->endereco;
    }

    /**
     * @return string
     */
    public function getCidade(){
        return $this->cidade;
    }

    /**
     * @return string
     */
    public function getEstado(){
        return $this->estado;
    }
    /**
     * @return string
     */
    public function getCep(){
        return $this->cep;
    }
    /**
     * @return string
     */
    public function getCpf(){
        return $this->cpf;
    }
    /**
     * @param string $date
     * @param string $format
     * @return boolean
     */
    function validateDate($date, $format = 'd/m/Y') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    /**
     * @param string $cpf
     * @return boolean
     */
    function validarCpf($cpf){
        $validacao_primeiro_digito = 0;
        $posicao_digito = 0;
        for($i = 10; $i > 1; $i++){
            $valor_digito = intval($cpf[$posicao_digito]);
            $validacao_primeiro_digito += $valor_digito * $i;
            $posicao_digito++;
        }

        $validacao_primeiro_digito = $validacao_primeiro_digito * 10;
        $validacao_primeiro_digito = $validacao_primeiro_digito % 11;
        if(!$validacao_primeiro_digito == $cpf[9]){
            return false;
        }
        $validacao_segundo_digito = 0;
        $posicao_digito = 0;
        for($i = 11; $i > 1; $i++){
            $valor_digito = intval($cpf[$posicao_digito]);
            $validacao_primeiro_digito += $valor_digito * $i;
            $posicao_digito++;
        }

        $validacao_segundo_digito = $validacao_segundo_digito * 10;
        $validacao_segundo_digito = $validacao_segundo_digito * 10;
        if(!$validacao_segundo_digito == $cpf[10]){
            return false;
        }
        return true;
    }











}