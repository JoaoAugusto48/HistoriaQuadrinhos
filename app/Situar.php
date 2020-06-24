<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Situar extends Model
{
    protected $table = 'situars';

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
