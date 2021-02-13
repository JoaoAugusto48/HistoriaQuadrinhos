<?php

namespace App\Http\Controllers\Quadrinho;

use App\Http\Controllers\Controller;
use App\Models\Hq;
use App\Models\Problematizar;
use App\Models\Quadrinho;
use App\Models\Solucionar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProblematizarController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'hqId' => 'required'
        ]);

        $hq = $request->get('hqId');

        $problematizars = Problematizar::where('hq_id','=', $hq)->orderBy('id','desc')->first();
        $hqUser = Hq::where('id','=', $hq)->first();

        $paginaProblematizar = $problematizars->quadrinho->pagina+1;

        $solucionars = Solucionar::where('hq_id','=',$hq)->get();
        if($solucionars->count() > 0){
            $this->alterarPaginaSolucionar($solucionars);
        }

        $quadrinho = new Quadrinho();
        $quadrinho->titulo = null;
        $quadrinho->pathImg = null;
        $quadrinho->pagina = $paginaProblematizar;
        $quadrinho->user_id = $hqUser->user_id;

        $quadrinho->save();

        $problematizar = FaseController::adicionarProblematizar($quadrinho, $hq);

        return response()->json(
            [
                'success' => true,
                'problematizar' => $problematizar,
                'problematizarId' => $problematizar->quadrinho->id,
                'problematizarPagina' => $problematizar->quadrinho->pagina,
            ]
        );

        // return redirect()->route('hq.show',$hq);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $problematizar = Problematizar::findOrFail($request->problematizar);

        $problematizar->delete();

        $file_name = $problematizar->quadrinho->pathImg;
        Storage::delete([$file_name]);

        Quadrinho::destroy($problematizar->quadrinho_id);

        $this->atualizarPaginaProblematizar($problematizar);

        $solucionars = Solucionar::where('hq_id','=',$problematizar->hq_id)->get();
        $this->alterarPaginaSolucionar($solucionars, -1);

        return redirect()->route('hq.show', $problematizar->hq_id);
    }

    private function alterarPaginaSolucionar($solucionars, $valorSomarPagina = 1){ // somar página
        foreach($solucionars as $solucionar){
            // Atualizando as páginas em Solucionars para que possa ser inserido um quadrinho em Problematizar
            $paginaSolucionar = $solucionar->quadrinho->pagina + $valorSomarPagina;

            DB::table('quadrinhos')->where('id','=', $solucionar->quadrinho->id)
                ->update([
                    'pagina' => $paginaSolucionar
                ]);
        }
    }

    private function atualizarPaginaProblematizar($problematizar){ // subtrair página
        $paginaProblematizars = Problematizar::where('hq_id','=',$problematizar->hq_id)->where('quadrinho_id','>',$problematizar->quadrinho_id)->get();

        foreach($paginaProblematizars as $paginaProblematizar){
            // Atualizando as páginas em Solucionars para que possa ser inserido um quadrinho em Problematizar
            $atualizarPagina = $paginaProblematizar->quadrinho->pagina-1;

            DB::table('quadrinhos')->where('id','=', $paginaProblematizar->quadrinho->id)
                ->update([
                    'pagina' => $atualizarPagina
                ]);
        }
    }
}
