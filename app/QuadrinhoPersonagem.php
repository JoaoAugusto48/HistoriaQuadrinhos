<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuadrinhoPersonagem extends Model
{
    protected $table = 'quadrinhoPersonagens';

    protected $fillable = [
        'id', 'balao1_id', 'balao2_id'
    ];

    public function balao1(){
        return $this->belongsTo('App\Balao');
    }

    public function balao2(){
        return $this->belongsTo('App\Balao');
    }
}
