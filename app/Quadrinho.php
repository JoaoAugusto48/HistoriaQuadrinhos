<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quadrinho extends Model
{
    protected $table = 'quadrinhos';

    protected $fillable = [
        'id', 'titulo', 'pathImg', 'pagina'
    ];
}
