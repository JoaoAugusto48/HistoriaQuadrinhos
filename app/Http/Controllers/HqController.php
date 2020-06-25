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
        return view('home');
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
        // dd($personagems);

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
            'personagem1' => 'required',
            'personagem2' => 'required',
            'ambiente' => 'required'
        ]);
        
        $hq = new Hq();
        $hq->tema = $request->get('tema');
        $hq->local = $request->get('local');
        $hq->personagem1 = $request->get('personagem1');
        $hq->personagem2 = $request->get('personagem2');
        $hq->ambiente = $request->get('ambiente');
        
        // $hq->save();

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
