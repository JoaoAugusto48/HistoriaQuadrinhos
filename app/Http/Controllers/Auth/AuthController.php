<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Auth::user();

        return view('auth.index', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function atualizarUsuario(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nome' => 'max:255|required'
        ]);

        $idUser = $request->get('id');
        $nomeUser = trim($request->get('nome'));

        $userName = User::where('id','=', $idUser)->first();
        if($userName->name != $nomeUser){
            User::where('id','=', $idUser)
                ->update([
                    'name' => $nomeUser
                ]);    
        }
        
        return redirect()->route('usuario.index');
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

    public function atualizarSenha(Request $request){
        $request->validate([
            'id' => 'required',
            'senha_antiga' => ['required', 'string'],
            'nova_senha' => ['required', 'string', 'min:8'],
            'confirmar_senha' => ['required','same:nova_senha']
        ]);

        $id = $request->get('id');
        $senhaAntiga = $request->get('senha_antiga');
        $novaSenha = $request->get('nova_senha');

        $user = User::where('id','=', $id)->first();
        
        $validacaoSenha = $this->validaSenha($user, $senhaAntiga, $novaSenha);
        
        //Validação das senhas criadas
        if(!$validacaoSenha['validacao']){
            return redirect()->route('usuario.index')->with($validacaoSenha['mensagens']);
        }

        User::where('id','=', $id)
            ->update([
                'password' => Hash::make($novaSenha)
            ]);
        
        return redirect()->route('usuario.index')->with('success', 'Senha atualizada!');
    }

    /**
     * Usado para consferir as senhas se estão de acordo com os requisitos de cada área
     * Criando também uma mensagem de erro para cada situação
     */
    private function validaSenha($user, $senhaAntiga, $novaSenha){
        $mensagens = [];
        $validarSenha = true;
        
        $comparaSenhaAntiga = Hash::check($senhaAntiga, $user->password);
        if(!$comparaSenhaAntiga){
            $mensagem = 'A senha antiga está incorreta!';
            array_push($mensagens, $mensagem);
            $validarSenha = false;
        }

        $novaEAntiga = Hash::check($novaSenha, $user->password);
        if($novaEAntiga){
            $mensagem = 'A nova senha não pode ser igual a antiga!';
            array_push($mensagens, $mensagem);
            $validarSenha = false;
        }

        return [
            'validacao' => $validarSenha,
            'mensagens' => $mensagens
        ];
    }

}
