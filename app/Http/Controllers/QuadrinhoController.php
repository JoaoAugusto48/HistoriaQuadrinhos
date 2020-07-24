<?php

namespace App\Http\Controllers;

use App\Balao;
use App\Hq;
use App\Quadrinho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuadrinhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('quadrinhos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quadrinho.index', compact('hq'));
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
     * @param  \App\Quadrinho  $quadrinho
     * @return \Illuminate\Http\Response
     */
    public function show(Quadrinho $quadrinho)
    {
        // $hq = Hq::findOrFail($hqId);
        // $quadrinho = Quadrinho::findOrFail($quadrinhoId);

        // $balaos = Balao::get();

        // return view('quadrinhos.index', compact('hq', 'quadrinho', 'balaos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quadrinho  $quadrinho
     * @return \Illuminate\Http\Response
     */
    public function edit($hqId, $quadrinhoId)
    {
        $hq = Hq::findOrFail($hqId);
        $quadrinho = Quadrinho::findOrFail($quadrinhoId);

        $balaos = Balao::get();

        return view('quadrinhos.index', compact('hq', 'quadrinho', 'balaos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quadrinho  $quadrinho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'imgQuadrinho' => 'required'
        ]);

        $base64_image = $request->get("imgQuadrinho"); // your base64 encoded     
        @list($type, $file_data) = explode(';', $base64_image);
        @list(, $file_data) = explode(',', $file_data);

        Storage::disk('public')->put('Teste.png', base64_decode($file_data));

        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quadrinho  $quadrinho
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quadrinho $quadrinho)
    {
        //
    }
}
