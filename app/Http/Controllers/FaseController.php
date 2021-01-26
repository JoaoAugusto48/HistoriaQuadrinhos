<?php

namespace App\Http\Controllers;

use App\Fase;
use App\Problematizar;
use App\Quadrinho;
use App\Situar;
use App\Solucionar;
use Illuminate\Http\Request;

class FaseController extends Controller
{
    private static function adicionarFase($fase, Quadrinho $quadrinho, $hqId){
        $fase->hq_id = $hqId;
        $fase->quadrinho_id = $quadrinho->id;

        $fase->save();
        return $fase;
    }

    /*
    * Adicionar a cada quadrinho a relação com a Hq principal
    */
    static function adicionarSituar(Quadrinho $quadrinho, $hqId){
        return FaseController::adicionarFase(new Situar(), $quadrinho, $hqId);
    }

    static function adicionarProblematizar(Quadrinho $quadrinho, $hqId){
        return FaseController::adicionarFase(new Problematizar(), $quadrinho, $hqId);
    }

    static function adicionarSolucionar(Quadrinho $quadrinho, $hqId){
        return FaseController::adicionarFase(new Solucionar(), $quadrinho, $hqId);
    }

}
