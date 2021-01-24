<?php

namespace App\Http\Controllers;

use App\Ambiente;
use App\Balao;
use App\Hq;
use App\Mensagem;
use App\Personagem;
use App\Problematizar;
use App\Quadrinho;
use App\QuadrinhoPersonagem;
use App\Situar;
use App\Solucionar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        // $hqs = Hq::where('user_id','=', Auth::user()->id)->orderby('id','desc')->get();

        // $caminho_imagem = ArquivoController::caminho_storage();

        // return view('hq.home', compact('hqs', 'caminho_imagem'));
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
        $hq->personagem1_id = $request->get('personagem1_id');
        $hq->personagem2_id = $request->get('personagem2_id');
        $hq->ambiente_id = $request->get('ambiente_id');
        $hq->software_id = $request->get('softwareId');
        $hq->user_id = Auth::user()->id;
        
        $hq->save();

        ArquivoController::folder_path($hq->id, $hq->user_id);

        $this->adicionarQuadrinhos($hq);

        // return redirect('/funcionario')->with('error', 'Deu erro!');

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

        $validaURL = ValidarController::validaURL($hq);
        if($validaURL){
            return $validaURL;
        }
        
        $situars = Situar::where('hq_id', '=', $hq->id)->get();
        $problematizars = Problematizar::where('hq_id', '=', $hq->id)->get();
        $solucionars = Solucionar::where('hq_id', '=', $hq->id)->get();

        $quadrinhoPersonagens = QuadrinhoPersonagem::get()->first();
        
        $situarQuadrinho = $situars[3]->quadrinho->pathImg ? true : false;
        
        $problematizarQuadrinho = true;
        foreach($problematizars as $problematizar){
            if(!$problematizar->quadrinho->pathImg){
                $problematizarQuadrinho = false;
            }
        }
        
        $solucionarQuadrinho = true;
        if($solucionars->isEmpty()){ //verificando se esse vetor está vazio
            $solucionarQuadrinho = false;
        }else {
            foreach($solucionars as $solucionar){
                if(!$solucionar->quadrinho->pathImg){
                    $solucionarQuadrinho = false;
                }
            }
        }
        
        $caminho_imagem = ArquivoController::caminho_storage(); //endereço do projeto, local: pasta storage
        

        return view('hq.show', 
            compact('hq', 'situars', 'problematizars', 'solucionars', 'caminho_imagem',
            'situarQuadrinho', 'problematizarQuadrinho', 'solucionarQuadrinho',
            'quadrinhoPersonagens')
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

        DB::table('quadrinhos')->where('id','=',$situar->quadrinho_id)
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

        $situars = Situar::where('hq_id','=',$hq->id)->get();
        Situar::where('hq_id','=',$hq->id)->delete();
        foreach($situars as $situar){
            DB::table('quadrinhos')->where('id','=',$situar->quadrinho_id)->delete();
        }

        $problematizars = Problematizar::where('hq_id','=',$hq->id)->get();
        Problematizar::where('hq_id','=',$hq->id)->delete();
        foreach($problematizars as $problematizar){
            DB::table('quadrinhos')->where('id','=',$problematizar->quadrinho_id)->delete();
        }

        $solucionars = Solucionar::where('hq_id','=',$hq->id)->get();
        Solucionar::where('hq_id','=',$hq->id)->delete();
        foreach($solucionars as $solucionar){
            DB::table('quadrinhos')->where('id','=',$solucionar->quadrinho_id)->delete();
        }

        $hq->delete();

        $arquivo = ArquivoController::folder_name($hq->id, $hq->user_id);
        Storage::deleteDirectory($arquivo);

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

}
