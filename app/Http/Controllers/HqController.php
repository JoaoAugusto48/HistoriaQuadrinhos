<?php

namespace App\Http\Controllers;

use App\Ambiente;
use App\Balao;
use App\Hq;
use App\Personagem;
use App\Problematizar;
use App\Quadrinho;
use App\Situar;
use App\Solucionar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hqs = Hq::get();

        return view('home', compact('hqs'));
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
            'ambiente_id' => 'required'
        ]);
        
        $hq = new Hq();
        $hq->tema = $request->get('tema');
        $hq->local = $request->get('local');
        $hq->personagem1_id = $request->get('personagem1_id');
        $hq->personagem2_id = $request->get('personagem2_id');
        $hq->ambiente_id = $request->get('ambiente_id');
        
        $hq->save();

        // $quadrinho = new Quadrinho();
        // $quadrinho->titulo = null;
        // $quadrinho->pagina = 1;

        // $quadrinho->save();

        $this->adicionarQuadrinhos($hq);

        // $situar = new Situar();
        // $situar->hq_id = Hq::latest()->first()->id;
        // $situar->quadrinho_id = Quadrinho::latest()->first()->id;

        // $situar->save();

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
        
        return view('hq.show', compact('hq', 'situars', 'problematizars', 'solucionars', 'balaos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hq  $hq
     * @return \Illuminate\Http\Response
     */
    public function edit(Hq $hq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hq  $hq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hq $hq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hq  $hq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hq $hq)
    {
        //
    }

    /*
    *  Adicionando todos os quadrinhos da primeira fase, os que já possuem padrão
    */
    public function adicionarQuadrinhos(Hq $hq){
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
    public function adicionarSituar(Quadrinho $quadrinho){
        $situar = new Situar();
        $situar->hq_id = Hq::latest()->first()->id;
        $situar->quadrinho_id = $quadrinho->id;

        $situar->save();
    }
}
