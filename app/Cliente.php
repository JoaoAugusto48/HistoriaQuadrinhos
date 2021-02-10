<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'id', 'nome', 'responsavel', 'email', 'telefone', 'cidade',
        'endereco', 'numero', 'complemento', 'estado_id', 'status'
    ];

    public function estado(){
        return $this->belongsTo('App\Estado', 'estado_id');
    }
}
