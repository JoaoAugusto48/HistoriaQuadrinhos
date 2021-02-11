<?php

namespace App\Http\Controllers\Gerencia;

use App\Http\Controllers\Controller;
use App\Software;
use Illuminate\Http\Request;

class MascaraController extends Controller
{
    public static function data($data){
        return date('d/m/Y', strtotime($data));
    }

    public static function telefone($telefone){
        if(strlen($telefone) == 8){
            $telefone = preg_replace('~.*(\d{4})[^\d]{0,8}(\d{4}).*~', '$1-$2', $telefone);
        } else
            if(strlen($telefone) == 9){
                $telefone = preg_replace('~.*(\d{5})[^\d]{0,8}(\d{4}).*~', '$1-$2', $telefone);
            } else
                if(strlen($telefone) == 10){
                    $telefone = preg_replace('~.*(\d{2})[^\d]{0,8}(\d{4})[^\d]{0,8}(\d{4}).*~', '($1)$2-$3', $telefone);
                } else
                    // if(strlen($telefone) == 11){
                    //     $telefone = preg_replace('~.*(\d{2})[^\d]{0,8}(\d{5})[^\d]{0,8}(\d{4}).*~', '($1)$2-$3', $telefone);
                    // } else
                        if(strlen($telefone) == 11){
                            $telefone = preg_replace('~.*(\d{2})[^\d]{0,8}(\d{2})[^\d]{0,8}(\d{4})[^\d]{0,8}(\d{4}).*~', '+$1 ($2)$3-$3', $telefone);
                        }

        dd($telefone);
    }
}
