<?php

namespace App\Http\Controllers;

use App\Problematizar;
use App\Quadrinho;
use App\Solucionar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SolucionarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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
            'hqId' => 'required'
        ]);

        $hq = $request->get('hqId');
        
        $solucionar = Solucionar::where('hq_id','=', $hq)->orderBy('id','desc')->first();
        if($solucionar){
            $paginaSolucionar = $solucionar->quadrinho->pagina+1;
        }
        else{
            // recuperando o ultimo quadrinho inserido a essa Hq
            $problematizar = Problematizar::where('hq_id','=', $hq)->orderBy('id','desc')->first();

            $paginaSolucionar = $problematizar->quadrinho->pagina+1;
        }
        

        $quadrinho = new Quadrinho();
        $quadrinho->titulo = null;
        $quadrinho->pathImg = null;
        $quadrinho->pagina = $paginaSolucionar;

        $quadrinho->save();

        $solucionar = new Solucionar();
        $solucionar->hq_id = $hq;
        $solucionar->quadrinho_id = $quadrinho->id;

        $solucionar->save();

        return redirect()->route('hq.show',$hq);
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
        $solucionar = Solucionar::findOrFail($request->solucionar);
        
        $solucionar->delete();

        $file_name = QuadrinhoController::file_name($solucionar->hq_id, $solucionar->quadrinho->pagina);
        Storage::delete([$file_name]);

        Quadrinho::destroy($solucionar->quadrinho_id);

        $this->atualizarPaginaSolucionar($solucionar);

        return redirect()->route('hq.show', $solucionar->hq_id);
    }

    public function atualizarPaginaSolucionar($solucionar){ // subtrair página
        $paginaSolucionars = Solucionar::where('hq_id','=',$solucionar->hq_id)->where('quadrinho_id','>',$solucionar->quadrinho_id)->get();
        
        foreach($paginaSolucionars as $paginaSolucionar){
            // Atualizando as páginas em Solucionars para que possa ser inserido um quadrinho em Problematizar 
            $atualizarPagina = $paginaSolucionar->quadrinho->pagina-1;
            
            DB::table('quadrinhos')->where('id','=', $paginaSolucionar->quadrinho->id)
                ->update([
                    'pagina' => $atualizarPagina
                ]);
        }
    }
    
}
