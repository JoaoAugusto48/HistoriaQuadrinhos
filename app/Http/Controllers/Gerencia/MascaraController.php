<?php

namespace App\Http\Controllers\Gerencia;

use App\Http\Controllers\Controller;
use App\Models\Software;
use Illuminate\Http\Request;

class MascaraController extends Controller
{
    public static function data($data){
        return date('d/m/Y', strtotime($data));
    }

    public static function telefone($telefone){
        return MascaraController::foneFormato($telefone);
    }

    private static function foneFormato($telefone){
        switch(strlen($telefone)){
            case 8: {return preg_replace('~.*(\d{4})[^\d]{0,8}(\d{4}).*~', '$1-$2', $telefone);break;}
            case 9: {return preg_replace('~.*(\d{5})[^\d]{0,8}(\d{4}).*~', '$1-$2', $telefone);break;}
            case 10: {return preg_replace('~.*(\d{2})[^\d]{0,8}(\d{4})[^\d]{0,8}(\d{4}).*~', '($1)$2-$3', $telefone);break;}
            case 11: {return preg_replace('~.*(\d{2})[^\d]{0,8}(\d{5})[^\d]{0,8}(\d{4}).*~', '($1)$2-$3', $telefone);break;}
            case 12: {return preg_replace('~.*(\d{2})[^\d]{0,8}(\d{2})[^\d]{0,8}(\d{4})[^\d]{0,8}(\d{4}).*~', '+$1 ($2)$3-$4', $telefone);break;}
            case 13: {return preg_replace('~.*(\d{2})[^\d]{0,8}(\d{2})[^\d]{0,8}(\d{5})[^\d]{0,8}(\d{4}).*~', '+$1 ($2)$3-$4', $telefone);break;}
            default: {return $telefone;}
        }
    }
}
