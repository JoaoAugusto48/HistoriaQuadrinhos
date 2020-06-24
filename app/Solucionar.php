<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solucionar extends Model
{
    protected $table = 'solucionars';

    protected $fillable = [
        'id', 'hq_id', 'quadrinho_id'
    ];

    public function hq(){
        return $this->belongsTo('App\Hq');
    }

    public function quadrinho(){
        return $this->belongsTo('App\Quadrinho');
    }
}
