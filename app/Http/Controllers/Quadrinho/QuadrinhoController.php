<?php

namespace App\Http\Controllers\Quadrinho;

use App\Http\Controllers\Controller;
use App\Models\Balao;
use App\Models\Hq;
use App\Http\Controllers\Gerencia\ArquivoController;
use App\Http\Controllers\Gerencia\ValidarController;
use App\Models\Personagem;
use App\Models\Problematizar;
use App\Models\Quadrinho;
use App\Models\Situar;
use App\Models\Utensilio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class QuadrinhoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

        $validaURL = ValidarController::validaURL($hq->user->id);
        if($validaURL){
            return $validaURL;
        }

        $quadrinho = Quadrinho::findOrFail($quadrinhoId);

        $faseQuadrinho = $this->faseQuadrinho($quadrinho->id);

        $balaos = Balao::where('status','=', true)->get();
        $utensilios = Utensilio::where('status','=', true)->get();
        $personagems = Personagem::where('status','=', true)
            ->where('id','<>',$hq->personagem1_id)
            ->where('id','<>',$hq->personagem2_id)->get();

        $caminho_imagem = ArquivoController::caminho_storage();

        return view('quadrinhos.gerarQuadrinho',
            compact('hq', 'quadrinho', 'balaos', 'utensilios', 'personagems', 'caminho_imagem', 'faseQuadrinho'));
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
        // dd($titulo);

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

        // Teste caso tenha imagem, é criado nome para o arquivo,
        // caso não a imagem atual é deletada para ser adicionada outra no local
        $file_name = $quadrinho->pathImg;

        if(!$quadrinho->pathImg){
            $file_name = ArquivoController::file_name($hqId, Auth::user()->id);
        }
        else {// Deletando a imagem atual e atualizando
            Storage::delete([$file_name]);
        }
        Storage::disk('public')->put($file_name, base64_decode($file_data));

        Quadrinho::where('id','=',$quadrinhoId)
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


    public static function store($titulo, $pagina, $user_id, $hq, $fase = 'situar')
    {
        $quadrinho = new Quadrinho();
        $quadrinho->titulo = $titulo;
        $quadrinho->pagina = $pagina;
        $quadrinho->user_id = $user_id;

        $quadrinho->save();

        if($fase == 'situar'){
            FaseController::adicionarSituar($quadrinho, $hq);
        } else
        if($fase == 'problematizar') {
            FaseController::adicionarProblematizar($quadrinho, $hq);
        } else if($fase == 'solucionar') {
            FaseController::adicionarSolucionar($quadrinho, $hq);
        }

    }

    /**
     * função criada para recuperar o estado do quadrinho
     */
    private function faseQuadrinho($idQuadrinho){
        $problematizar = Problematizar::where('quadrinho_id','=', $idQuadrinho)->get()->first();
        $situar = Situar::where('quadrinho_id','=', $idQuadrinho)->get()->first();
        // não é necessário realizar o solucionar
        // $solucionar = Solucionar::where('quadrinho_id','=', $idQuadrinho)->get()->first();

        $faseQuadrinho = [
            'fase' => 'Solucionar',
            'mensagem' => 'Dê detalhes sobre possíveis soluções para as dificuldades apresentadas nos quadrinhos em "Problematizar".'
        ];

        if($problematizar){
            $faseQuadrinho = [
                'fase' => 'Problematizar',
                'mensagem' => 'Dê detalhes sobre as dificuldades presentes no meio em que essa HQ se encontra.'
            ];
        } else if($situar) {
            $faseQuadrinho = [
                'fase' => 'Situar',
                'mensagem' => 'Determinar em que época, em que período de tempo se passa a HQ.'
            ];
        }

        return $faseQuadrinho;
    }

}
