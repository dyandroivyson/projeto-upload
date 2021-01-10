<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    protected $table = 'arquivos';
    
    protected $primaryKey  = 'arquivo_id';
    
    protected $fillable = [
        'user_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'arquivo_users', 'arquivo_id', 'user_id');
    }

    public function userCadastro()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
