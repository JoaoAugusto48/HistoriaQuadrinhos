<?php

namespace App\Http\Controllers;

use App\Hq;
use App\Problematizar;
use App\Quadrinho;
use Illuminate\Http\Request;

class ProblematizarController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Hq $hq)
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
        // dd($request->all());

        $request->validate([
            'hqId' => 'required'
        ]);

        $hq = $request->get('hqId');
        
        $problematizars = Problematizar::where('hq_id','=', $hq);
        dd($problematizars);
        
        $maior = 0;
        foreach($problematizars as $problematizar){
            $maior_pagina = Quadrinho::where('id','=',$problematizar)->get('pagina');
            // var_dump($maior_pagina);
            // if($maior_pagina > $maior){
            //     $maior = $maior_pagina;
            // }
        }

        dd($maior);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
