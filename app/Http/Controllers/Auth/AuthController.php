<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nome' => 'max:255|required'
        ]);

        $idUser = $request->get('id');
        $nomeUser = $request->get('nome');


        DB::table('users')->where('id','=', $idUser)
            ->update([
                'name' => $nomeUser
            ]);
        
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
        dd($request->all());
        $request->validate([
            'id' => 'required',
            'senha_antiga' => ['required', 'string', 'min:8', 'confirmed'],
            'nova_senha' => ['required', 'string', 'min:8', 'confirmed'],
            'confirmar_senha'
        ]);

        $user = User::where('id','=', $request->get('id'));

    }
}
