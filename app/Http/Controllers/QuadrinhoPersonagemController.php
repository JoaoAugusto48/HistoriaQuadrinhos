<?php

namespace App\Http\Controllers;

use App\Balao;
use App\QuadrinhoPersonagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuadrinhoPersonagemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quadPer = QuadrinhoPersonagem::get()->first();
        $balaos = Balao::orderby('descricao')->get();
        $caminho_imagem = ArquivoController::caminho_storage();

        return view('gerencia.balao.quadrinhoPersonagens', compact('quadPer', 'caminho_imagem', 'balaos'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'balao_esquerda' => 'required',
            'balao_direita' => 'required'
        ]);

        $balaoQuadrinho2 = new QuadrinhoPersonagem();
        $balaoQuadrinho2->id = $request->get('id');
        $balaoQuadrinho2->balao_esquerda = $request->get('balao_esquerda');
        $balaoQuadrinho2->balao_direita = $request->get('balao_direita');

        $antigo = QuadrinhoPersonagem::where('id', '=', $balaoQuadrinho2->id)->get()->first();
        if(($balaoQuadrinho2->balao_esquerda == $antigo->balao_esquerda) && ($balaoQuadrinho2->balao_direita == $antigo->balao_direita)){
            return redirect()->route('quadrinhoPersonagem.index');
        }

        QuadrinhoPersonagem::where('id', '=', $balaoQuadrinho2->id)
            ->update([
                'balao_esquerda' => $balaoQuadrinho2->balao_esquerda,
                'balao_direita' => $balaoQuadrinho2->balao_direita
            ]);

        return redirect()->route('quadrinhoPersonagem.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
