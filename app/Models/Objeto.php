<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objeto extends Model
{
    protected $table = 'objetos';

    protected $fillable = [
        'id', 'quadrinho_id', 'utensilio_id', 'balao_id'
    ];

    public function quadrinho(){
        return $this->belongsTo('App\Models\Quadrinho', 'quadrinho_id');
    }

    public function utensilio(){
        return $this->belongsTo('App\Models\Utensilio', 'utensilio_id');
    }

    public function balao(){
        return $this->belongsTo('App\Models\Balao', 'balao_id');
    }
}
