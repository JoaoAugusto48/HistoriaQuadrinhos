<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $table = 'softwares';

    protected $fillable = [
        'id', 'descricao', 'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
