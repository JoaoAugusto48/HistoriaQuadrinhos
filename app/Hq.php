<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hq extends Model
{
    protected $table = 'hqs';

    protected $fillable = [
        'id', 'tema', 'local', 'saudacao1', 'saudacao2', 'status',
        'personagem1_id', 'personagem2_id', 'ambiente_id', 'software_id', 'user_id'
    ];

    public function personagem1(){
        return $this->belongsTo('App\Personagem', 'personagem1_id');
    }

    public function personagem2(){
        return $this->belongsTo('App\Personagem', 'personagem2_id');
    }

    public function ambiente(){
        return $this->belongsTo('App\Ambiente', 'ambiente_id');
    }

    public function software(){
        return $this->belongsTo('App\Software', 'software_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
