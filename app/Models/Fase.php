<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    protected $fillable = [
        'id', 'hq_id', 'quadrinho_id'
    ];

    public function hq(){
        return $this->belongsTo('App\Models\Hq', 'hq_id');
    }

    public function quadrinho(){
        return $this->belongsTo('App\Models\Quadrinho', 'quadrinho_id');
    }
}
