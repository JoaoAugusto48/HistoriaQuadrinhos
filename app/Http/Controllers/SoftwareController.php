<?php

namespace App\Http\Controllers;

use App\Hq;
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
        $softwares = Software::where('user_id','=', Auth::user()->id)->orderby('id','desc')->get();

        // $hq = Hq::where('')
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
        return view('software.create');
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
        ]);

        $software = new Software();
        $software->descricao = trim($request->get('descricao'));
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
        Hq::where('software_id','=',$software->id)->delete();
        dd($software);
        $software->delete();

        return redirect()->route('software.index');
    }
}
