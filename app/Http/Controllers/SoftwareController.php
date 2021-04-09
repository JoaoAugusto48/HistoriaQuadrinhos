<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Hq;
use App\Http\Controllers\Gerencia\ArquivoController;
use App\Http\Controllers\Gerencia\MascaraController;
use App\Http\Controllers\Gerencia\MensagemController;
use App\Http\Controllers\Gerencia\ValidarController;
use App\Models\Software;
use Carbon\Carbon;
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
            ->orderby('prazo','asc')
            ->get();

        // dd($dataHoje->diff($softwares[0]->prazo));
        $msgExclusao = new MensagemController();

        $dataHoje = Carbon::now();
        foreach($softwares as $software){
            $software->difPrazo = $dataHoje->diff($software->prazo)->format('%a');
        }

        SoftwareController::vetorData($softwares);
        SoftwareController::vetorTelefone($softwares);

        $dataHoje = MascaraController::data($dataHoje);

        // $validaURL = ValidarController::validaURL($hq);
        // if($validaURL){
        //     return $validaURL;
        // }

        return view('index', compact('softwares', 'msgExclusao'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::where('user_id','=',Auth::user()->id)->where('status','=',true)->distinct()->get();
        // dd($clientes);

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
            'cliente_id' => 'required|integer',
        ]);

        $software = new Software();
        $software->descricao = trim($request->get('descricao'));
        $software->status = true;
        $software->prazo = $request->get('prazo');
        $software->entregue = false;
        $software->cliente_id = $request->get('cliente_id');
        $software->user_id = Auth::user()->id;

        if(!is_numeric($software->cliente_id)){
            return redirect()->route('software.create')->with('error', 'Deu erro!');
        }

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
        $validaURL = ValidarController::validaURL($software->user_id);
        if($validaURL){
            return $validaURL;
        }

        $hqs = Hq::where('user_id','=', Auth::user()->id)
            ->where('software_id','=',$software->id)
            ->where('status','=',true)
            ->orderby('id','desc')
            ->get();
        $caminho_imagem = ArquivoController::caminho_storage();

        $msgExclusao = new MensagemController();

        return view('software.show', compact('hqs', 'caminho_imagem', 'software', 'msgExclusao'));
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

    private static function vetorData($softwares){
        foreach($softwares as $software){
            $software->prazo = MascaraController::data($software->prazo);
        }
    }

    private static function vetorTelefone($softwares){
        foreach($softwares as $software){
            $software->cliente->telefone = MascaraController::telefone($software->cliente->telefone);
        }
    }

    public function getCliente($clienteId){
        $softCli = Cliente::where('id', $clienteId)->with('estado')->get()->first();

        $softCli->telefone = MascaraController::telefone($softCli->telefone);
        // dd($softCli);
        return response()->json($softCli);
    }
}
