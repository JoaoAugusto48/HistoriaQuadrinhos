<?php

namespace App\Http\Controllers\Quadrinho;

use App\Http\Controllers\Controller;
use App\Models\Hq;
use App\Http\Controllers\Gerencia\ArquivoController;
use App\Models\Problematizar;
use App\Models\Quadrinho;
use App\Models\Solucionar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SolucionarController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'hqId' => 'required',
            'criarSolucionar' // valor para diferenciar a criação por js ou php
        ]);

        $hq = $request->get('hqId');

        $hqUser = Hq::where('id','=', $hq)->first();

        $solucionar = Solucionar::where('hq_id','=', $hq)->orderBy('id','desc')->first();
        if($solucionar){
            $paginaSolucionar = $solucionar->quadrinho->pagina+1;
        }
        else{
            // recuperando o ultimo quadrinho inserido a essa Hq
            $problematizar = Problematizar::where('hq_id','=', $hq)->orderBy('id','desc')->first();
            $paginaSolucionar = $problematizar->quadrinho->pagina+1;
        }

        QuadrinhoController::store(null,$paginaSolucionar,$hqUser->user_id, $hq, 'solucionar');

        if($request->get('criarSolucionar') == 'valorGeradoEstaticamente'){
            return redirect()->route('hq.show',$hq);
        }

        return response()->json(
            [
                'success' => true,
                'solucionar' => $solucionar,
                'solucionarId' => $solucionar->quadrinho->id,
                'solucionarPagina' => $solucionar->quadrinho->pagina,
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
        $solucionar = Solucionar::findOrFail($request->solucionar);

        $solucionar->delete();

        $file_name = ArquivoController::file_name($solucionar->hq_id, $solucionar->quadrinho->pagina);
        Storage::delete([$file_name]);

        Quadrinho::destroy($solucionar->quadrinho_id);

        $this->atualizarPaginaSolucionar($solucionar);

        return redirect()->route('hq.show', $solucionar->hq_id);
    }

    private function atualizarPaginaSolucionar($solucionar){ // subtrair página
        $paginaSolucionars = Solucionar::where('hq_id','=',$solucionar->hq_id)->where('quadrinho_id','>',$solucionar->quadrinho_id)->get();

        foreach($paginaSolucionars as $paginaSolucionar){
            // Atualizando as páginas em Solucionars para que possa ser inserido um quadrinho em Problematizar
            $atualizarPagina = $paginaSolucionar->quadrinho->pagina-1;

            Quadrinho::where('id','=', $paginaSolucionar->quadrinho->id)
                ->update([
                    'pagina' => $atualizarPagina
                ]);
        }
    }

}
