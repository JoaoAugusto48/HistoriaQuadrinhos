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
        return $this->belongsTo('App\Quadrinho');
    }

    public function utensilio(){
        return $this->belongsTo('App\Utensilio');
    }
}
