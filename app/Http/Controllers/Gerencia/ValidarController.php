<?php

namespace App\Http\Controllers\Gerencia;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ValidarController extends Controller
{
    public static function validaURL($validacao){
        // teste para validação de URL com usuário logado
        return ValidarController::testeValidacao($validacao->user->id,Auth::user()->id);
    }

    public static function validaURLId($userId){
        return ValidarController::testeValidacao($userId,Auth::user()->id);
    }

    private static function testeValidacao($userId,$authId){
        if($userId != $authId){
            return redirect()->route('home');
        }
        return 0;
    }

}
