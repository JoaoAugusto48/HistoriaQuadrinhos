<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use App\Models\Hq;
use App\Http\Controllers\Gerencia\ArquivoController;
use App\Http\Controllers\Gerencia\MensagemController;
use App\Http\Controllers\Gerencia\ValidarController;
use App\Http\Controllers\Quadrinho\QuadrinhoController;
use App\Models\Personagem;
use App\Models\Problematizar;
use App\Models\Quadrinho;
use App\Models\QuadrinhoPersonagem;
use App\Models\Situar;
use App\Models\Solucionar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
    public function create($softwareId)
    {
        $personagems = Personagem::where('status','=', true)->get();
        $ambientes = Ambiente::where('status','=', true)->get();

        $caminho_imagem = ArquivoController::caminho_storage();

        return view('hq.create', compact('personagems', 'ambientes', 'caminho_imagem', 'softwareId'));
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
            'tema' => 'required|max:100',
            'local' => 'required|max:70',
            'personagem1_id' => 'required|different:personagem2_id',
            'personagem2_id' => 'required',
            'ambiente_id' => 'required',
            'saudacao1' => 'required|max:70',
            'saudacao2' => 'required|max:70',
            'softwareId' => 'required'
        ]);

        $hq = new Hq();
        $hq->tema = trim($request->get('tema'));
        $hq->local = trim($request->get('local'));
        $hq->saudacao1 = trim($request->get('saudacao1'));
        $hq->saudacao2 = trim($request->get('saudacao2'));
        $hq->status = true;
        $hq->personagem1_id = $request->get('personagem1_id');
        $hq->personagem2_id = $request->get('personagem2_id');
        $hq->ambiente_id = $request->get('ambiente_id');
        $hq->software_id = $request->get('softwareId');
        $hq->user_id = Auth::user()->id;

        $hq->save();

        ArquivoController::folder_path($hq->id, $hq->user_id);

        $this->adicionarQuadrinhos($hq);

        return redirect()->route('software.show', $hq->software_id)->with('error', 'Deu erro!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hq  $hq
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $hq = Hq::FindOrFail($request->hq);

        $validaURL = ValidarController::validaURL($hq->user->id);
        if($validaURL){
            return $validaURL;
        }

        $msgExclusao = new MensagemController();

        $situars = Situar::where('hq_id', '=', $hq->id)->get();
        $problematizars = Problematizar::where('hq_id', '=', $hq->id)->get();
        $solucionars = Solucionar::where('hq_id', '=', $hq->id)->get();

        $quadrinhoPersonagens = QuadrinhoPersonagem::get()->first();

        $situarQuadrinho = $this->pagina4temImagem($situars[3]->quadrinho->pathImg);
        $problematizarQuadrinho = $this->mostrarImagens($problematizars);
        $solucionarQuadrinho = $this->mostrarImagensSolucionar($solucionars);

        $caminho_imagem = ArquivoController::caminho_storage(); //endereço do projeto, local: pasta storage

        return view('hq.show',
            compact('hq', 'situars', 'problematizars', 'solucionars', 'caminho_imagem',
            'situarQuadrinho', 'problematizarQuadrinho', 'solucionarQuadrinho',
            'quadrinhoPersonagens', 'msgExclusao')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hq  $hq
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $hq = Hq::findOrFail($request->hq);

        $validaURL = ValidarController::validaURL($hq);
        if($validaURL){
            return $validaURL;
        }

        return view('hq.edit', compact('hq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hq  $hq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'tema' => 'required|max:100',
            'local' => 'required|max:70',
            'saudacao1' => 'required|max:70',
            'saudacao2' => 'required|max:70'
        ]);

        $hq = Hq::findOrFail($request->hq);
        $hq->id = $request->get('id');
        $hq->tema = $request->get('tema');
        $hq->local = $request->get('local');
        $hq->saudacao1 = $request->get('saudacao1');
        $hq->saudacao2 = $request->get('saudacao2');

        $hq->update();

        $situar = Situar::where('hq_id','=',$hq->id)->orderBy('id', 'asc')->first();

        Quadrinho::where('id','=',$situar->quadrinho_id)
            ->update(['titulo' => $hq->tema]);

        return redirect()->route('hq.show', $hq->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hq  $hq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $hq = Hq::findOrFail($request->hq);

        Hq::where('id','=',$hq->id)->update(['status' => false]);

        // FaseController::deletarSituar($hq);
        // FaseController::deletarProblematizar($hq);
        // FaseController::deletarSolucionar($hq);

        // $hq->delete();

        // $arquivo = ArquivoController::folder_name($hq->id, $hq->user_id);
        // Storage::deleteDirectory($arquivo);

        return redirect()->route('software.show', $hq->software_id);
    }

    /*
    *  Adicionando todos os quadrinhos da primeira fase, os que já possuem padrão
    */
    private function adicionarQuadrinhos(Hq $hq){
        $hqId = Hq::latest()->first()->id;

        QuadrinhoController::store($hq->tema,1, $hq->user_id, $hqId);
        QuadrinhoController::store('Personagens',2, $hq->user_id, $hqId);
        QuadrinhoController::store('Ambiente de Trabalho',3, $hq->user_id, $hqId);
        QuadrinhoController::store(null,4, $hq->user_id, $hqId);
        QuadrinhoController::store(null,5, $hq->user_id, $hqId, 'problematizar');
    }

    private function mostrarImagens($fases){
        $faseQuadrinho = true;
        foreach($fases as $fase){
            if(!$fase->quadrinho->pathImg){
                $faseQuadrinho = false;
            }
        }
        return $faseQuadrinho;
    }

    private function mostrarImagensSolucionar($solucionars){
        if($solucionars->isEmpty()){ //verificando se esse vetor está vazio
            return false;
        }

        return $this->mostrarImagens($solucionars);
    }

    private function pagina4temImagem($quadrinhoPag4){
        return $quadrinhoPag4 ? true : false;
    }


    //otimizar
    // public static function deletarSituar($hq){
    //     $situars = Situar::where('hq_id','=',$hq->id)->get();

    //     Situar::where('hq_id','=',$hq->id)->delete();
    //     foreach($situars as $situar){
    //         DB::table('quadrinhos')->where('id','=',$situar->quadrinho_id)->delete();
    //     }
    // }

    // public static function deletarProblematizar($hq){
    //     $problematizars = Problematizar::where('hq_id','=',$hq->id)->get();

    //     Problematizar::where('hq_id','=',$hq->id)->delete();
    //     foreach($problematizars as $problematizar){
    //         DB::table('quadrinhos')->where('id','=',$problematizar->quadrinho_id)->delete();
    //     }
    // }

    // public static function deletarSolucionar($hq){
    //     $solucionars = Solucionar::where('hq_id','=',$hq->id)->get();

    //     Solucionar::where('hq_id','=',$hq->id)->delete();
    //     foreach($solucionars as $solucionar){
    //         DB::table('quadrinhos')->where('id','=',$solucionar->quadrinho_id)->delete();
    //     }
    // }

}
