<?php

namespace App\Http\Controllers;

use App\Ambiente;
use Illuminate\Http\Request;

class AmbienteController extends Controller
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
        GerenciarController::userGerente();

        $ambientes = Ambiente::orderby('descricao', 'asc')->get();

        $caminho_imagem = ArquivoController::caminho_storage();

        return view('gerencia.ambiente.ambiente', compact('ambientes', 'caminho_imagem'));
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
        dd($request->all());
        $request->validate([
            'descricao' => 'required|max:70',
            'img' => 'required',
            'repeteFundo'
        ]);
        
        $descricao = $request->get('descricao');
        $imagem = $request->file('img');
        $repeteFundo = $request->get('repeteFundo');
        
        $caminhoImagem = ArquivoController::caminho_imagem("ambiente", $imagem);
        
        $ambiente = new Ambiente();
        $ambiente->fundo = $caminhoImagem;
        $ambiente->status = true;
        $ambiente->descricao = $descricao;
        $ambiente->repeteFundo = $repeteFundo;

        $ambiente->save();

        return redirect()->route('ambiente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ambiente  $ambiente
     * @return \Illuminate\Http\Response
     */
    public function show(Ambiente $ambiente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ambiente  $ambiente
     * @return \Illuminate\Http\Response
     */
    public function edit(Ambiente $ambiente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ambiente  $ambiente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ambiente $ambiente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ambiente  $ambiente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ambiente $ambiente)
    {
        //
    }
}
