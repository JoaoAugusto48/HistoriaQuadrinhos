<?php

namespace App\Http\Controllers\Gerencia;

use App\Models\Cliente;
use App\Http\Controllers\Controller;
use App\Models\Hq;
use App\Models\Quadrinho;
use App\Models\Situar;
use App\Models\Software;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InformationController extends Controller
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
    public function index($userId)
    {
        $validaURL = ValidarController::validaURL($userId);
        if($validaURL){
            return $validaURL;
        }

        // clientes
        // recupera o número total de parcerias
        $nParceiros = Cliente::where('user_id','=',Auth::user()->id)->get('nome')->count();
        // recupera o número de parcerias em Contrato
        $nEmContrato = Cliente::where('user_id','=',Auth::user()->id)->where('status',true)->get('nome')->count();
        // recupera a parceria com mais contratos
        $maisProjeto = Software::where('user_id','=',Auth::user()->id)->get('cliente_id');
        if(!isset($maisProjeto[0])){
            $maisProjeto = false;
        }
        // recupera o número de contratos tem com a maior parceria
        $nMaisProjeto = Cliente::where('user_id','=',Auth::user()->id)->get('nome')->count();
        
        // softwares
        // recupera o número total de softwares criados
        $nSoftwares = Software::where('user_id','=', Auth::user()->id)->get()->count();
        // recupera o software com mais Hqs
        $maisHqs = Hq::where('user_id','=', Auth::user()->id)->get()->count();
        
        // HQs
        // recupera o presente número de softwares
        $hqAtuais = Hq::where('user_id','=', Auth::user()->id)->where('status',true)->get()->count();
        

        // Quadrinhos

        
        // recupera o quadrinho com mais páginas
        // recupera o ambiente mais usado
        // recupera o total de quadrinhos
        // $totalQuadrinho = Situar::where('');

        return view('information.index', compact('nParceiros', 'nEmContrato', 'maisProjeto',
                'nSoftwares', 'hqAtuais'));
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
    public function update(Request $request, $id)
    {
        //
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
