<?php

namespace App\Http\Controllers\Gerencia;

use App\Http\Controllers\Controller;
use App\Cliente;
use App\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
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
        $clientes = Cliente::where('user_id','=',Auth::user()->id)
            ->where('status','=',true)
            ->get();

        foreach($clientes as $cliente){
            $cliente->telefone = MascaraController::telefone($cliente->telefone);
        }

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

        $listaEmpresas = Cliente::where('user_id','=',Auth::user()->id)->get('nome');

        return view('cliente.create', compact('estados', 'saoPaulo', 'listaEmpresas'));
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
        $cliente->responsavel = trim($request->get('responsavel'));
        $cliente->email = trim($request->get('email'));
        $cliente->telefone = trim($request->get('telefone'));
        $cliente->cidade = trim($request->get('cidade'));
        $cliente->endereco = trim($request->get('endereco'));
        $cliente->numero = $request->get('numero');
        $cliente->complemento = trim($request->get('complemento'));
        $cliente->estado_id = $request->get('estado_id');
        $cliente->status = true;
        $cliente->user_id = Auth::user()->id;

        $this->formatarCliente($cliente);

        $cliente->save();

        return redirect()->route('cliente.index');
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

    private function formatarCliente(Cliente $cliente){
        $cliente->nome = $cliente->nome;
        $cliente->responsavel = $cliente->responsavel;
        $cliente->email = $cliente->email;
        $cliente->telefone = preg_replace('/\s+/', '', $cliente->telefone);
        $cliente->cidade = $cliente->cidade;
        $cliente->endereco = $cliente->endereco;
        $cliente->numero = $cliente->numero;
        $cliente->complemento = $cliente->complemento;

        return $cliente;
    }
}
