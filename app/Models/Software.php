<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $table = 'softwares';

    protected $fillable = [
        'id', 'descricao', 'prazo', 'status', 'entregue', 'cliente_id', 'user_id', 'difPrazo'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function cliente(){
        return $this->belongsTo('App\Models\Cliente', 'cliente_id');
    }
}
