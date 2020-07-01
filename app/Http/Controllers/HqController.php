<?php

namespace App\Http\Controllers;

use App\Ambiente;
use App\Hq;
use App\Personagem;
use Illuminate\Http\Request;

class HqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hqs = Hq::get();

        return view('home', compact('hqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personagems = Personagem::get();
        $ambientes = Ambiente::get();

        return view('hq.create', compact('personagems', 'ambientes'));
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
            'tema' => 'required|max:100',
            'local' => 'required|max:70',
            'personagem1_id' => 'required',
            'personagem2_id' => 'required',
            'ambiente_id' => 'required'
        ]);
        
        $hq = new Hq();
        $hq->tema = $request->get('tema');
        $hq->local = $request->get('local');
        $hq->personagem1_id = $request->get('personagem1_id');
        $hq->personagem2_id = $request->get('personagem2_id');
        $hq->ambiente_id = $request->get('ambiente_id');
        
        $hq->save();

        return redirect()->route('hq.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hq  $hq
     * @return \Illuminate\Http\Response
     */
    public function show(Hq $hq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hq  $hq
     * @return \Illuminate\Http\Response
     */
    public function edit(Hq $hq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hq  $hq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hq $hq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hq  $hq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hq $hq)
    {
        //
    }
}
