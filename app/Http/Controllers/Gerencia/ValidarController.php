<?php

namespace App\Http\Controllers\Gerencia;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ValidarController extends Controller
{
    public static function validaURL($userId){
        // teste para validação de URL com usuário logado
        return ValidarController::testeValidacao($userId, Auth::user()->id);
    }

    private static function testeValidacao($userId,$authId){
        if($userId != $authId){
            return redirect()->route('home');
        }
        return 0;
    }

}
