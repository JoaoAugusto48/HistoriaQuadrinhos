<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balao extends Model
{
    protected $table = 'balaos';

    protected $fillable = [
        'id', 'caminho', 'descricao', 'status'
    ];
}
