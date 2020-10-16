<?php

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
    private $nasc;
    private $genro;
    private $sang;
    private $endereco;
    private $cidade;
    private $estado;
    private $cep;
    private $cpf;
    private $frkPlano;

    /**
     * Paciente constructor.
     * @0 $nome
     * @1 $sobrenome
     * @2 $email
     * @3 $nasc
     * @4 $genro
     * @5 $sang
     * @6 $endereco
     * @7 $cidade
     * @8 $estado
     * @9 $cep
     * @10 $cpf
     * @11 $frkPlano
     * @throws EmailInvalidoException
     * @throws NascimentoInvalidoException
     * @throws CpfInvalidoException
     */


    public function __construct($nome, $sobrenome, $email, $nasc, $genro, $sang, $endereco, $cidade, $estado, $cep, $cpf, $frkPlano)
    {
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;

        $arr_mail = substr_count($email,"@");
        if($arr_mail > 1 || $arr_mail == 0){
            throw new EmailInvalidoException("Email inválido");
        }
        $this->email = $email;


        if(!$this->validateDate($nasc)){
            throw new NascimentoInvalidoException("Data inválida");
        }
        $this->nasc = $nasc;
        $this->genro = $genro;
        $this->sang = $sang;
        $this->endereco = $endereco;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->cep = $cep;

        if(strlen($cpf) != 11){
            throw new CpfInvalidoException("CPF INVALIDO");
        }
        $this->cpf = $cpf;

        $this->frkPlano = $frkPlano;
    }



    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @return string
     */
    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getNasc()
    {
        return $this->nasc;
    }

    /**
     * @return string
     */
    public function getGenro()
    {
        return $this->genro;
    }

    /**
     * @return string
     */
    public function getSang()
    {
        return $this->sang;
    }

    /**
     * @return string
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @return string
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @return string
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @return string
     */
    public function getFrkPlano()
    {
        return $this->frkPlano;
    }

    function validateDate($date, $format = 'd/m/Y')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }











}