<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupos';
    
    protected $primaryKey  = 'grupo_id';
    
    protected $fillable = [
        'grupo_nome'
    ];
}
