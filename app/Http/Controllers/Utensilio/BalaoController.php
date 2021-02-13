<?php

namespace App\Http\Controllers\Utensilio;

use App\Http\Controllers\Controller;
use App\Models\Balao;
use App\Http\Controllers\Gerencia\ArquivoController;
use App\Http\Controllers\Gerencia\GerenciarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BalaoController extends Controller
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

        $balaos = Balao::where('status','=', true)->orderby('descricao', 'asc')->get();

        $caminho_imagem = ArquivoController::caminho_storage();

        return view('gerencia.balao.balao', compact('balaos','caminho_imagem'));
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
            'img' => 'required'
        ]);

        $descricao = $request->get('descricao');
        $imagem = $request->file('img');

        $caminhoImagem = ArquivoController::caminho_imagem("balao", $imagem);

        $balao = new Balao();
        $balao->caminho = $caminhoImagem;
        $balao->status = true;
        $balao->descricao = $descricao;

        $balao->save();

        return redirect()->route('balao.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Balao  $balao
     * @return \Illuminate\Http\Response
     */
    public function show(Balao $balao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Balao  $balao
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $balao = Balao::FindOrFail($request->balao);

        if(!$balao->status){
            return redirect()->route('balao.index');
        }

        $caminho_imagem = ArquivoController::caminho_storage();

        return view('gerencia.balao.editBalao', compact('balao', 'caminho_imagem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Balao  $balao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'descricao' => 'required|max:70'
        ]);

        $balao = new Balao();
        $balao->id = $request->get('id');
        $balao->descricao = trim($request->get('descricao'));

        $validarDescricao = $this->verificarDescricao($balao->id, $balao->descricao);
        // dd($validarDescricao);
        if($validarDescricao){
            Balao::where('id','=',$balao->id)
                ->update([
                    'descricao' => $balao->descricao
                ]);
            return redirect()->route('balao.index');
        }

        return redirect()->route('balao.editBalao', $balao->id)
                ->withErrors(['error', 'Já possui balão com a descrição "'. $balao->descricao.'"!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Balao  $balao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $balao = Balao::FindOrFail($request->balao);

        DB::table('balaos')->where('id','=',$balao->id)
                ->update([
                    'status' => false
                ]);

        return redirect()->route('balao.index');
    }

    private function verificarDescricao($id, $descricao){
        $verificar = Balao::where('id', '<>', $id)
                    ->where('descricao','=',$descricao)
                    ->where('status','=',true)->get();

        return ($verificar->count() > 0) ? false : true;
    }
}
