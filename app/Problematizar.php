<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problematizar extends Model
{
    protected $table = 'problematizars';

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
