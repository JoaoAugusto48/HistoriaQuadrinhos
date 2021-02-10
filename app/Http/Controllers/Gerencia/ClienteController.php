<?php

namespace App\Http\Controllers\Gerencia;

use App\Http\Controllers\Controller;
use App\Cliente;
use App\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::where('user_id','=',Auth::user()->id)
            ->where('status','=',true)
            ->get();

        return view('cliente.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::get();
        $saoPaulo = Estado::where('uf','=','sp')->first();

        return view('cliente.create', compact('estados', 'saoPaulo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validade([
            'nome' => 'required|max:100',
            'responsavel' => 'required|max:100',
            'email' => 'required|max:255',
            'telefone' => 'required|max:14',
            'cidade' => 'required|max:50',
            'endereco' => 'required|max:50',
            'numero' => 'required',
            'complemento' => 'max:30',
            'estado_id' => 'required',
        ]);

        $cliente = new Cliente();
        $cliente->nome = trim($request->get('nome'));
        $cliente->responsavel = trim($request->get('nome'));
        $cliente->email = trim($request->get('nome'));
        $cliente->telefone = trim($request->get('nome'));
        $cliente->cidade = trim($request->get('nome'));
        $cliente->endereco = trim($request->get('nome'));
        $cliente->numero = $request->get('nome');
        $cliente->complemento = trim($request->get('nome'));
        $cliente->estado_id = trim($request->get('nome'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
