<?php

namespace App\Http\Controllers;

use App\Fase;
use App\Problematizar;
use App\Quadrinho;
use App\Situar;
use App\Solucionar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaseController extends Controller
{
    /** ------------------------
     * Create
     */
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

    /** -----------------
     * Delete
     */

    public static function deletarFase($fase, $hq){
        $fases = $fase->where('hq_id','=',$hq->id)->get();
        
        $fase->where('hq_id','=',$hq->id)->delete();
        foreach($fases as $fase){
            Quadrinho::where('id','=',$fase->quadrinho_id)->delete();
        }
    }

    /*
    * Deletar a cada quadrinho a relação com a Hq principal
    */
    public static function deletarSituar($hq){
        FaseController::deletarFase(new Situar, $hq);
    }

    public static function deletarProblematizar($hq){
        FaseController::deletarFase(new Problematizar, $hq);
    }

    public static function deletarSolucionar($hq){
        FaseController::deletarFase(new Solucionar, $hq);
    }

}
