<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hq extends Model
{
    protected $table = 'hqs';

    protected $fillable = [
        'id', 'tema', 'local', 'saudacao1', 'saudacao2', 'personagem1_id', 'personagem2_id', 'ambiente_id', 'user_id'
    ];

    public function personagem1(){
        return $this->belongsTo('App\Personagem');
    }

    public function personagem2(){
        return $this->belongsTo('App\Personagem');
    }

    public function ambiente(){
        return $this->belongsTo('App\Ambiente');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
