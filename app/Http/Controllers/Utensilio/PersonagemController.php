<?php

namespace App\Http\Controllers\Utensilio;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Gerencia\ArquivoController;
use App\Http\Controllers\Gerencia\GerenciarController;
use App\Personagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonagemController extends Controller
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

        $personagens = Personagem::where('status','=', true)
                ->orderByRaw('LENGTH(descricao) asc')
                ->orderby('descricao', 'asc')
                ->get();

        $caminho_imagem = ArquivoController::caminho_storage();

        return view('gerencia.personagem.personagem', compact('personagens', 'caminho_imagem'));
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

        $caminhoImagem = ArquivoController::caminho_imagem("personagem", $imagem);

        $personagem = new Personagem();
        $personagem->personagem = $caminhoImagem;
        $personagem->status = true;
        $personagem->descricao = $descricao;

        $personagem->save();

        return redirect()->route('personagem.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Personagem  $personagem
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personagem  $personagem
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $personagem = Personagem::FindOrFail($request->personagem);

        if(!$personagem->status){
            return redirect()->route('personagem.index');
        }

        $caminho_imagem = ArquivoController::caminho_storage();

        return view('gerencia.personagem.edit', compact('personagem', 'caminho_imagem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personagem  $personagem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'descricao' => 'required|max:70'
        ]);

        $personagem = new Personagem();
        $personagem->id = $request->get('id');
        $personagem->descricao = trim($request->get('descricao'));

        $validarDescricao = $this->verificarDescricao($personagem->id, $personagem->descricao);
        // dd($validarDescricao);
        if($validarDescricao){
            Personagem::where('id','=',$personagem->id)
                ->update([
                    'descricao' => $personagem->descricao
                ]);
            return redirect()->route('personagem.index');
        }

        return redirect()->route('personagem.edit', $personagem->id)
                ->withErrors(['error', 'Já possui personagem com a descrição "'. $personagem->descricao.'"!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personagem  $personagem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $personagem = Personagem::FindOrFail($request->personagem);

        DB::table('personagems')->where('id','=',$personagem->id)
                ->update([
                    'status' => false
                ]);

        return redirect()->route('personagem.index');
    }


    private function verificarDescricao($id, $descricao){
        $verificar = Personagem::where('id', '<>', $id)
                    ->where('descricao','=',$descricao)
                    ->where('status','=',true)->get();

        return ($verificar->count() > 0) ? false : true;
    }
}
