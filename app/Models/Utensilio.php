<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utensilio extends Model
{
    protected $table = 'utensilios';

    protected $fillable = [
        'id', 'caminho', 'descricao', 'status'
    ];
}
