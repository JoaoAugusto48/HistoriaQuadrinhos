<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GerenciarController extends Controller
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
        GerenciarController::userGerente();

        return view('gerencia.gerencia');
    }

    public static function userGerente(){
        if(Auth::user()->privilegio < 1){
            return redirect()->route('hq.index');
        }
    }

}
