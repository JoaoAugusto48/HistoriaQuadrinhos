<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $table = 'softwares';

    protected $fillable = [
        'id', 'descricao', 'prazo', 'status', 'cliente_id', 'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function cliente(){
        return $this->belongsTo('App\Cliente', 'cliente_id');
    }
}
