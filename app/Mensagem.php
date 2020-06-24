<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $table = 'mensagems';

    protected $fillable = [
        'id', 'texto', 'quadrinho_id', 'personagem_id'
    ];

    public function quadrinho(){
        return $this->belongsTo('App\Quadrinho');
    }

    public function personagem(){
        return $this->belongsTo('App\Personagem');
    }
}
