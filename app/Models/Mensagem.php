<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $table = 'mensagems';

    protected $fillable = [
        'id', 'texto', 'quadrinho_id', 'personagem_id', 'balao_id'
    ];

    public function quadrinho(){
        return $this->belongsTo('App\Models\Quadrinho', 'quadrinho_id');
    }

    public function personagem(){
        return $this->belongsTo('App\Models\Personagem', 'personagem_id');
    }

    public function balao(){
        return $this->belongsTo('App\Models\Balao', 'balao_id');
    }
}
