<?php

namespace App\Http\Controllers;

use App\Quadrinho;
use Illuminate\Http\Request;

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
     * @param  \App\Quadrinho  $quadrinho
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $quadrinho = Quadrinho::findOrFail($request->hq);

        return route('quadrinho.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quadrinho  $quadrinho
     * @return \Illuminate\Http\Response
     */
    public function edit(Quadrinho $quadrinho)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quadrinho  $quadrinho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quadrinho $quadrinho)
    {
        //
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
