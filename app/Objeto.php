<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objeto extends Model
{
    protected $table = 'objetos';

    protected $fillable = [
        'id', 'quadrinho_id', 'utensilio_id', 'balao_id'
    ];

    public function quadrinho(){
        return $this->belongsTo('App\Quadrinho', 'quadrinho_id');
    }

    public function utensilio(){
        return $this->belongsTo('App\Utensilio', 'utensilio_id');
    }

    public function balao(){
        return $this->belongsTo('App\Balao', 'balao_id');
    }
}
