<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    protected $fillable = [
        'id', 'hq_id', 'quadrinho_id'
    ];

    public function hq(){
        return $this->belongsTo('App\Hq', 'hq_id');
    }

    public function quadrinho(){
        return $this->belongsTo('App\Quadrinho', 'quadrinho_id');
    }
}
