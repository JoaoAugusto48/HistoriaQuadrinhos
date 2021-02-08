<?php

namespace App\Http\Controllers;

use App\Ambiente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $ambientes = Ambiente::where('status','=', true)->orderby('descricao', 'asc')->get();

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
        $request->validate([
            'descricao' => 'required|max:70',
            'img' => 'required',
            'repeteFundo' //chkbox
        ]);

        $descricao = $request->get('descricao');
        $imagem = $request->file('img');
        $repeteFundo = $request->has('repeteFundo');

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
    public function edit(Request $request)
    {
        $ambiente = Ambiente::FindOrFail($request->ambiente);

        if(!$ambiente->status){
            return redirect()->route('ambiente.index');
        }

        $caminho_imagem = ArquivoController::caminho_storage();

        return view('gerencia.ambiente.edit', compact('ambiente', 'caminho_imagem'));
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
        $request->validate([
            'id' => 'required',
            'descricao' => 'required|max:70',
            'repeteFundo' //chkbox
        ]);

        $ambiente = new Ambiente();
        $ambiente->id = $request->get('id');
        $ambiente->descricao = trim($request->get('descricao'));
        $ambiente->repeteFundo = $request->has('repeteFundo');

        $validarDescricao = $this->verificarDescricao($ambiente->id, $ambiente->descricao);

        if($validarDescricao){
            Ambiente::where('id','=',$ambiente->id)
                ->update([
                    'descricao' => $ambiente->descricao,
                    'repeteFundo' => $ambiente->repeteFundo
                ]);
            return redirect()->route('ambiente.index');
        }

        return redirect()->route('ambiente.edit', $ambiente->id)
                ->withErrors(['error', 'Já possui ambiente com a descrição "'. $ambiente->descricao.'"!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ambiente  $ambiente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ambiente = Ambiente::FindOrFail($request->ambiente);

        DB::table('ambientes')->where('id','=',$ambiente->id)
                ->update([
                    'status' => false
                ]);

        return redirect()->route('ambiente.index');
    }

    private function verificarDescricao($id, $descricao){
        $verificar = Ambiente::where('id', '<>', $id)
                    ->where('descricao','=',$descricao)
                    ->where('status','=',true)->get();

        return ($verificar->count() > 0) ? false : true;
    }
}
