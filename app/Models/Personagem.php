<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personagem extends Model
{
    protected $table = 'personagems';

    protected $fillable = [
        'id', 'personagem', 'descricao', 'status'
    ];
}
