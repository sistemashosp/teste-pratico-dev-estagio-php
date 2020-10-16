<?php


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
     */


    public function __construct($nome, $sobrenome, $email, $nasc, $genro, $sang, $endereco, $cidade, $estado, $cep, $cpf, $frkPlano)
    {
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->email = $email;
        $this->nasc = $nasc;
        $this->genro = $genro;
        $this->sang = $sang;
        $this->endereco = $endereco;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->cep = $cep;
        $this->cpf = $cpf;
        $this->frkPlano = $frkPlano;
    }



    public function toString(){
            return $this->nome . $this->sobrenome . $this->email . $this->nasc . $this->genro . $this->sang
            . $this->endereco . $this->cidade . $this->endereco . $this->cep . $this->cpf . $this->frkPlano;
    }
    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @return mixed
     */
    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getNasc()
    {
        return $this->nasc;
    }

    /**
     * @return mixed
     */
    public function getGenro()
    {
        return $this->genro;
    }

    /**
     * @return mixed
     */
    public function getSang()
    {
        return $this->sang;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @return mixed
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @return mixed
     */
    public function getFrkPlano()
    {
        return $this->frkPlano;
    }











}