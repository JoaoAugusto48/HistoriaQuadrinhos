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
        return view('quadrinhos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('quadrinho.index', compact('hq'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $quadrinho = new Quadrinho();
        // $quadrinho->titulo = null;
        // $quadrinho->pathImg = null;
        // $quadrinho->pagina = 1; //algum valor


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

        return view('quadrinhos.index', compact('hq', 'quadrinho', 'balaos'));
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

        // consulta ao banco do quadrinho apresentado
        $quadrinho = Quadrinho::where('id','=',$quadrinhoId)->get()->first();

        //Passando a codificação de Base64 para imagem 
        $base64_image = $imgQuadrinho; // your base64 encoded     
        @list($type, $file_data) = explode(';', $base64_image);
        @list(, $file_data) = explode(',', $file_data);
        
        // $exists = Storage::disk('public')->exists('users/user/'.$hqId);

        // $folder_path = $this->folder_path($hqId);

        // Storage::disk('public')->makeDirectory('users/user/'.$hqId);
        $file_name = $this->file_name($hqId, $quadrinho->pagina);
        Storage::disk('public')->put($file_name, base64_decode($file_data));

        // Relações entre Hq e Quadrinhos
        // como testar se um valor vindo do banco de dados existe ou não
        // $situar = Situar::where('hq_id','=',$hqId)->where('quadrinho_id','=',$quadrinhoId);
        // var_dump($situar);
        // dd($situar);

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
    public function destroy(Quadrinho $quadrinho)
    {
        //
    }

    // para recuperar o nome do folder
    public static function folder_name($hqId, $user = 'user'){
        return 'users/'.$user.'/hq_'.$hqId;
    }

    // para recuperar o caminho do falder e o criar
    public static function folder_path($hqId){
        // Teste de existencia do Diretório
        $folder_path = QuadrinhoController::folder_name($hqId);
        if(!Storage::disk('public')->exists($folder_path)){ // se o diretório não existe
            Storage::disk('public')->makeDirectory($folder_path);
        }
        return $folder_path;
    }

    // para recuperar o nome do arquivo
    public static function file_name($hqId, $pagina){
        $folder_path = QuadrinhoController::folder_path($hqId);
        return $folder_path.'/pag_'. $pagina.'.png';
    }
    
}
