<?php

namespace App\Http\Controllers\Utensilio;

use App\Http\Controllers\Controller;
use App\Models\Objeto;
use Illuminate\Http\Request;

class ObjetoController extends Controller
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
        //
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
     * @param  \App\Objeto  $objeto
     * @return \Illuminate\Http\Response
     */
    public function show(Objeto $objeto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Objeto  $objeto
     * @return \Illuminate\Http\Response
     */
    public function edit(Objeto $objeto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Objeto  $objeto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objeto $objeto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Objeto  $objeto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Objeto $objeto)
    {
        //
    }
}
