<?php

namespace App\Http\Controllers;

use App\Ambiente;
use App\Balao;
use App\Hq;
use App\Mensagem;
use App\Personagem;
use App\Problematizar;
use App\Quadrinho;
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
        $hqs = Hq::where('user_id','=', Auth::user()->id)->get();

        $caminho_imagem = ArquivoController::caminho_storage();

        return view('index', compact('hqs', 'caminho_imagem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personagems = Personagem::get();
        $ambientes = Ambiente::get();

        return view('hq.create', compact('personagems', 'ambientes'));
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
            'personagem1_id' => 'required',
            'personagem2_id' => 'required',
            'ambiente_id' => 'required',
            'saudacao1' => 'required|max:70',
            'saudacao2' => 'required|max:70'
        ]);
        
        $hq = new Hq();
        $hq->tema = trim($request->get('tema'));
        $hq->local = trim($request->get('local'));
        $hq->saudacao1 = trim($request->get('saudacao1'));
        $hq->saudacao2 = trim($request->get('saudacao2'));
        $hq->personagem1_id = $request->get('personagem1_id');
        $hq->personagem2_id = $request->get('personagem2_id');
        $hq->ambiente_id = $request->get('ambiente_id');
        $hq->user_id = Auth::user()->id;
        
        $hq->save();

        ArquivoController::folder_path($hq->id, $hq->user_id);

        $this->adicionarQuadrinhos($hq);

        $quadrinho = new Quadrinho();
        $quadrinho->titulo = null;
        $quadrinho->pagina = 5;

        $quadrinho->save();

        $problematizar = new Problematizar();
        $problematizar->hq_id = Hq::latest()->first()->id;
        $problematizar->quadrinho_id = $quadrinho->id;

        $problematizar->save();

        return redirect()->route('hq.index');
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
        
        $situars = Situar::where('hq_id', '=', $hq->id)->get();
        $problematizars = Problematizar::where('hq_id', '=', $hq->id)->get();
        $solucionars = Solucionar::where('hq_id', '=', $hq->id)->get();


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
        
        return view('hq.show', compact('hq', 'situars', 'problematizars', 'solucionars', 'caminho_imagem',
            'situarQuadrinho', 'problematizarQuadrinho', 'solucionarQuadrinho'));
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

        return redirect()->route('hq.index');
    }

    /*
    *  Adicionando todos os quadrinhos da primeira fase, os que já possuem padrão
    */
    private function adicionarQuadrinhos(Hq $hq){
        $quadrinho1 = new Quadrinho();
        $quadrinho1->titulo = $hq->tema;
        $quadrinho1->pagina = 1;

        $quadrinho1->save();

        $this->adicionarSituar($quadrinho1);

        $quadrinho2 = new Quadrinho();
        $quadrinho2->titulo = "Personagens";
        $quadrinho2->pagina = 2;

        $quadrinho2->save();

        $this->adicionarSituar($quadrinho2);

        $quadrinho3 = new Quadrinho();
        $quadrinho3->titulo = "Ambiente de Trabalho";
        $quadrinho3->pagina = 3;

        $quadrinho3->save();

        $this->adicionarSituar($quadrinho3);

        $quadrinho4 = new Quadrinho();
        $quadrinho4->titulo = null;
        $quadrinho4->pagina = 4;

        $quadrinho4->save();

        $this->adicionarSituar($quadrinho4);
    }

    /*
    * Adicionar a cada quadrinho a relação com a Hq principal
    */
    private function adicionarSituar(Quadrinho $quadrinho){
        $situar = new Situar();
        $situar->hq_id = Hq::latest()->first()->id;
        $situar->quadrinho_id = $quadrinho->id;

        $situar->save();
    }
}
