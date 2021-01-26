<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class GerenciarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private static $privilegio = [
        'semPrivilegio' => 0,
        'comPrivilegio' => 1
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $naoEGerente = GerenciarController::userGerente();

        return $naoEGerente ? $naoEGerente : view('gerencia.gerencia');
    }

    public static function userGerente(){
        if(Auth::user()->privilegio < GerenciarController::$privilegio['comPrivilegio']){
            return redirect()->route('software.index');
        }
    }

}
