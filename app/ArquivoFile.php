<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArquivoFile extends Model
{
    protected $table = 'arquivo_files';
    
    protected $primaryKey  = 'arquivo_file_id';
    
    protected $fillable = [
        'nome_arquivo', 'tamanho', 'arquivo_id'
    ];

    public function arquivo()
    {
        return $this->hasOne(Arquivo::class, 'arquivo_id', 'arquivo_id');
    }

    public static function list()
    {
        return self::select('arquivos.arquivo_id', 'arquivo_files.nome_arquivo', 
                'arquivo_files.tamanho', 'users.name')
            ->join('arquivos', 'arquivos.arquivo_id', '=', 
                'arquivo_files.arquivo_id')
            ->join('users', 'users.id', '=', 'arquivos.user_id')
            ->paginate(10);
    }
}
