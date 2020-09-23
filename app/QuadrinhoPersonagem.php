<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuadrinhoPersonagem extends Model
{
    protected $table = 'quadrinhoPersonagens';

    protected $fillable = [
        'id', 'balao_esquerda', 'balao_direita'
    ];

    public function balaoEsq(){
        return $this->belongsTo('App\Balao', 'balao_esquerda');
    }

    public function balaoDir(){
        return $this->belongsTo('App\Balao', 'balao_direita');
    }
}
