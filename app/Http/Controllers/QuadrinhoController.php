<?php

namespace App\Http\Controllers;

use App\Balao;
use App\Hq;
use App\Quadrinho;
use App\Situar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class QuadrinhoController extends Controller
{
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
     * @param  \App\Quadrinho  $quadrinho
     * @return \Illuminate\Http\Response
     */
    public function show(Quadrinho $quadrinho)
    {
        // $hq = Hq::findOrFail($hqId);
        // $quadrinho = Quadrinho::findOrFail($quadrinhoId);

        // $balaos = Balao::get();

        // return view('quadrinhos.index', compact('hq', 'quadrinho', 'balaos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quadrinho  $quadrinho
     * @return \Illuminate\Http\Response
     */
    public function edit($hqId, $quadrinhoId)
    {
        $hq = Hq::findOrFail($hqId);
        $quadrinho = Quadrinho::findOrFail($quadrinhoId);

        $balaos = Balao::get();

        return view('quadrinhos.gerarQuadrinho', compact('hq', 'quadrinho', 'balaos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quadrinho  $quadrinho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'hqId' => 'required',
            'quadrinhoId' => 'required',
            'imgQuadrinho' => 'required',
            'titulo' => 'max:255'
        ]);

        $hqId = $request->get('hqId');
        $quadrinhoId = $request->get('quadrinhoId');
        $imgQuadrinho = $request->get('imgQuadrinho');
        $titulo = trim($request->get('titulo'));

        // verificando se titulo possui algum valor para caso não, ele seja null
        if(strlen($titulo) == 0){
            $titulo = null;
        }

        // consulta ao banco do quadrinho apresentado
        $quadrinho = Quadrinho::where('id','=',$quadrinhoId)->get()->first();

        //Passando a codificação de Base64 para imagem 
        $base64_image = $imgQuadrinho; // your base64 encoded     
        @list($type, $file_data) = explode(';', $base64_image);
        @list(, $file_data) = explode(',', $file_data);
        
        $file_name = $quadrinho->pathImg;
        if(!$quadrinho->pathImg){
            $file_name = $this->file_name($hqId);
            Storage::disk('public')->put($file_name, base64_decode($file_data));
        }

        DB::table('quadrinhos')->where('id','=',$quadrinhoId)
            ->update([
                'pathImg' => $file_name,
                'titulo' => $titulo
            ]);

        return redirect()->route('hq.show', $hqId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quadrinho  $quadrinho
     * @return \Illuminate\Http\Response
     */
    public static function destroy(Quadrinho $quadrinho)
    {
        $quadrinho->delete();
    }
    
}
