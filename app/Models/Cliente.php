<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'id', 'nome', 'responsavel', 'email', 'telefone', 'cidade',
        'endereco', 'numero', 'complemento', 'estado_id', 'status', 'user_id'
    ];

    public function estado(){
        return $this->belongsTo('App\Models\Estado', 'estado_id');
    }

    public function usuario(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
