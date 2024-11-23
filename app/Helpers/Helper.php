<?php

namespace App\Helpers;

class Helper
{
    public static function ValidateMSISDN($msisdn, $prefix = "234567")
    {
        $validMSISDN = "";
        $prefix = $prefix ?: "234567";
        switch (1) {
            case preg_match("/[+](258)(8)[" . $prefix . "]([0-9]){7,7}/i", $msisdn):
                $validMSISDN = trim(str_replace('+', '', $msisdn));
                break;
            case preg_match("/(258)(8)[" . $prefix . "]([0-9]){7,7}/i", $msisdn):
                $validMSISDN = $msisdn;
                break;
            case preg_match("/(8)[" . $prefix . "]([0-9]){7,7}/i", $msisdn):
                $validMSISDN = trim("258" . $msisdn);
                break;
            default:
                return false;
        }
        return $validMSISDN;
    }

    public static function removerAcentos($texto)
    {
        $acentos = array(
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a',
            'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
            'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'ñ' => 'n',
            'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o',
            'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u',
            'ý' => 'y',
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A',
            'Ç' => 'C',
            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
            'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
            'Ñ' => 'N',
            'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O',
            'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U',
            'Ý' => 'Y'
        );

        // Use strtr para realizar a substituição
        $fraseSemAcentos = strtr($texto, $acentos);

        return $fraseSemAcentos;
    }



}
