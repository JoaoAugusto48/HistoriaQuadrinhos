<?php

namespace App\Http\Controllers\Gerencia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MensagemController extends Controller
{
    public function excluirItemTabela($nomeItem, $item, $artigo='a'): string{
        return "Deseja realmente excluir $artigo $item - \"$nomeItem\"?";
    }
}
