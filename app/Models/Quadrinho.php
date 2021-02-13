<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quadrinho extends Model
{
    protected $table = 'quadrinhos';

    protected $fillable = [
        'id', 'titulo', 'pathImg', 'pagina', 'software_id'
    ];

    public function user(){
        return $this->belongsTo('App\Models\Software', 'software_id');
    }
}
