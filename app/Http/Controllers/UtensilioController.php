<?php

namespace App\Http\Controllers;

use App\Utensilio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtensilioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        GerenciarController::userGerente();

        $utensilios = Utensilio::where('status','=', true)->orderby('descricao', 'asc')->get();

        $caminho_imagem = ArquivoController::caminho_storage();

        return view('gerencia.utensilio.utensilio', compact('utensilios', 'caminho_imagem'));
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
        
        $caminhoImagem = ArquivoController::caminho_imagem("utensilio", $imagem);
        
        $utensilio = new Utensilio();
        $utensilio->caminho = $caminhoImagem;
        $utensilio->status = true;
        $utensilio->descricao = $descricao;

        $utensilio->save();

        return redirect()->route('utensilio.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Utensilio  $utensilio
     * @return \Illuminate\Http\Response
     */
    public function show(Utensilio $utensilio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Utensilio  $utensilio
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $utensilio = Utensilio::FindOrFail($request->utensilio);

        if(!$utensilio->status){
            return redirect()->route('utensilio.index');
        }

        $caminho_imagem = ArquivoController::caminho_storage();

        return view('gerencia.utensilio.edit', compact('utensilio', 'caminho_imagem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Utensilio  $utensilio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Utensilio $utensilio)
    {
        $request->validate([
            'id' => 'required',
            'descricao' => 'required|max:70'
        ]);

        $utensilio = new Utensilio();
        $utensilio->id = $request->get('id');
        $utensilio->descricao = trim($request->get('descricao'));

        $validarDescricao = $this->verificarDescricao($utensilio->id, $utensilio->descricao);
        // dd($validarDescricao);
        if($validarDescricao){
            DB::table('utensilios')->where('id','=',$utensilio->id)
                ->update([
                    'descricao' => $utensilio->descricao
                ]);
            return redirect()->route('utensilio.index');
        }

        return redirect()->route('utensilio.edit', $utensilio->id)
                ->withErrors(['error', 'Já possui utensilio com a descrição "'. $utensilio->descricao.'"!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Utensilio  $utensilio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $utensilio = Utensilio::FindOrFail($request->utensilio);

        DB::table('utensilios')->where('id','=',$utensilio->id)
                ->update([
                    'status' => false
                ]);

        return redirect()->route('utensilio.index');
    }

    private function verificarDescricao($id, $descricao){
        $verificar = Utensilio::where('id', '<>', $id)
                    ->where('descricao','=',$descricao)
                    ->where('status','=',true)->get();

        return ($verificar->count() > 0) ? false : true;
    }
}
