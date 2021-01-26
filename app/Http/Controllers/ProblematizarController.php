<?php

namespace App\Http\Controllers;

use App\Hq;
use App\Problematizar;
use App\Quadrinho;
use App\Solucionar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProblematizarController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Hq $hq)
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
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
