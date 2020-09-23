<?php

namespace App\Http\Controllers;

use App\Utensilio;
use Illuminate\Http\Request;

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

        $utensilios = Utensilio::orderby('descricao', 'asc')->get();

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
        //
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
    public function edit(Utensilio $utensilio)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Utensilio  $utensilio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Utensilio $utensilio)
    {
        //
    }
}
