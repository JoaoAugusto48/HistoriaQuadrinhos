<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidarController extends Controller
{
    public static function validaURL($hq){
        // teste para validação de URL com usuário logado
        $usuario = $hq->user;
        $usuarioAutenticado = Auth::user();

        if($usuario->id != $usuarioAutenticado->id){
            return redirect()->route('home');
        }
        return 0;
    }
}
