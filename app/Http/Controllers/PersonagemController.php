<?php

namespace App\Http\Controllers;

use App\Personagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $personagens = Personagem::orderby('descricao', 'asc')->get();

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
        
        // dd($request->all());
        $caminhoImagem = ArquivoController::caminho_imagem("personagem", $imagem);
        
        // Storage::disk('public')->put($caminhoImagem, $imagem->getClientOriginalName());
        dd($imagem->getRealPath());

        // Storage::disk('public')->put($file_name, base64_decode($file_data));

        return redirect()->route('personagem.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Personagem  $personagem
     * @return \Illuminate\Http\Response
     */
    public function show(Personagem $personagem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personagem  $personagem
     * @return \Illuminate\Http\Response
     */
    public function edit(Personagem $personagem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personagem  $personagem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personagem $personagem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personagem  $personagem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personagem $personagem)
    {
        //
    }
}
