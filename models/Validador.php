<?php


class Validador{

    /**
     * @param string $date
     * @param string $format
     * @return boolean
     *
     */
    public static function validateDate($date, $format = 'd/m/Y')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }


    /**
     * @param string $cpf
     * @return boolean
     *
     */
    public static function validarCpf($cpf){
        if(strlen($cpf) != 11){
            return false;
        }
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        $validacao_primeiro_digito = 0;
        $posicao_digito = 0;
        for($i = 10; $i > 1; $i--){
            $digito = $cpf[$posicao_digito];
            $valor_digito = intval($digito);
            $validacao_primeiro_digito += $valor_digito * $i;
            $posicao_digito++;
        }

        $validacao_primeiro_digito = $validacao_primeiro_digito * 10;
        $validacao_primeiro_digito = $validacao_primeiro_digito % 11;
        if($validacao_primeiro_digito == 10){
            $validacao_primeiro_digito = 0;
        }
        if($validacao_primeiro_digito != $cpf[9]){
            return false;
        }
        $validacao_segundo_digito = 0;
        $posicao_digito = 0;
        for($i = 11; $i > 1; $i--){
            $valor_digito = intval($cpf[$posicao_digito]);
            $validacao_segundo_digito += $valor_digito * $i;
            $posicao_digito++;
        }

        $validacao_segundo_digito = $validacao_segundo_digito * 10;
        $validacao_segundo_digito = $validacao_segundo_digito % 11;
        if($validacao_segundo_digito == 10){
            $validacao_segundo_digito = 0;
        }
        if($validacao_segundo_digito != $cpf[10]){
            return false;
        }
        return true;
    }
}