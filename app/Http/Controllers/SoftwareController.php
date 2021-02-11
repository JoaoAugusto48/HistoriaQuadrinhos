<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Hq;
use App\Http\Controllers\Gerencia\ArquivoController;
use App\Http\Controllers\Gerencia\MascaraController;
use App\Software;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoftwareController extends Controller
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
        $softwares = Software::where('user_id','=', Auth::user()->id)
            ->where('status','=',true)
            ->orderby('id','desc')
            ->get();

        $this->vetorData($softwares);
        $this->vetorTelefone($softwares);

        // $softwares[0]->prazo = date('d/m/Y', strtotime($softwares[0]->prazo));

        // $validaURL = ValidarController::validaURL($hq);
        // if($validaURL){
        //     return $validaURL;
        // }

        return view('index', compact('softwares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::where('user_id','=',Auth::user()->id)->get();

        return view('software.create', compact('clientes'));
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
            'descricao' => 'required|max:70',
            'prazo' => 'required',
            'cliente_id' => 'required',
        ]);

        $software = new Software();
        $software->descricao = trim($request->get('descricao'));
        $software->status = true;
        $software->prazo = $request->get('prazo');
        $software->cliente_id = $request->get('cliente_id');
        $software->user_id = Auth::user()->id;

        $software->save();

        return redirect()->route('software.index')->with('error', 'Deu erro!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function show(Software $software)
    {
        $hqs = Hq::where('user_id','=', Auth::user()->id)
            ->where('software_id','=',$software->id)
            ->where('status','=',true)
            ->orderby('id','desc')
            ->get();
        $caminho_imagem = ArquivoController::caminho_storage();

        return view('software.show', compact('hqs', 'caminho_imagem', 'software'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $software = Software::findOrFail($request->software);

        return view('software.edit', compact('software'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'descricao' => 'required|max:70',
        ]);

        $software = Software::findOrFail($request->software);
        $software->descricao = trim($request->get('descricao'));

        $software->update();

        return redirect()->route('software.show', $software->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $software = Software::findOrFail($request->software);

        Software::where('id','=',$software->id)->update(['status' => false]);

        //otimizar
        // $hqs = Hq::where('software_id','=',$software->id)->get();
        // foreach($hqs as $hq) {
        //     FaseController::deletarSituar($hq);
        //     FaseController::deletarProblematizar($hq);
        //     FaseController::deletarSolucionar($hq);

        //     Hq::where('id','=',$hq->id)->delete();
        // }

        // $software->delete();
        //
        // Hq::where('software_id','=',$software->id)->delete();

        return redirect()->route('software.index');
    }

    private function vetorData($softwares){
        foreach($softwares as $software){
            $software->prazo = MascaraController::data($software->prazo);
        }
    }

    private function vetorTelefone($softwares){
        foreach($softwares as $software){
            $software->cliente->telefone = MascaraController::telefone($software->cliente->telefone);
        }
    }
}
