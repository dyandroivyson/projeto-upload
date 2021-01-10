<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Arquivo;
use App\ArquivoFile;
use App\User;
use Hash;
use Storage;
use Str;
use URL;

class ArquivoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cadastrar(Request $request)
    {
        if (!isset($request->arquivos) && is_empty($request->arquivos)) {
            return response()->json([
                'msg' => 'É necessário anexar pelo menos um arquivo.'
            ], 403);
        }

        if (!isset($request->usuarios) && is_empty($request->usuarios)) {
            return response()->json([
                'msg' => 'É necessário informar pelo menos um usuário.'
            ], 403);
        }

        $user_cadastro = [
            'user_id' => auth()->user()->id
        ];

        $arquivo = Arquivo::create($user_cadastro);

        foreach ($request->file('arquivos') as $file) {
            $caminho = 'public/arquivos/' . $arquivo->arquivo_id;
            $nome = preg_replace('/\\.[^.\\s]{3,4}$/', '', 
                $file->getClientOriginalName());

            $nome_arquivo =  Str::slug($nome) . '_' . 
                \Carbon\Carbon::now()->timestamp . '.' . $file->extension();

            $file->storeAs($caminho, $nome_arquivo);

            $arquivo_file = [
                'nome_arquivo' => $nome_arquivo,
                'tamanho' => $file->getSize(),
                'arquivo_id' => $arquivo->arquivo_id
            ];

            ArquivoFile::create($arquivo_file);
        }

        foreach ($request->usuarios as $user_id) {
            $arquivo->users()->attach($user_id);
        }
        
        return response()->json([
            'msg' => 'Arquivo(s) cadastrado(s) com sucesso!'
        ], 201);
    }

    public function listar()
    {
        return response()->json(
            ArquivoFile::list()
        , 200);
    }

    public function ver($arquivo_id)
    {
        $arquivo = Arquivo::find($arquivo_id);
        if (is_null($arquivo)) {
            return response()->json([
                'msg' => 'Arquivo não encontrado.'
            ], 403);
        }

        $arquivo->userCadastro;
        $arquivo->users;

        return response()->json([
            'arquivo' => $arquivo
        ], 200);
    }

    public function baixar($arquivo_file_id)
    {
        $arquivo_file = ArquivoFile::find($arquivo_file_id);
        if (is_null($arquivo_file)) {
            return response()->json([
                'msg' => 'Arquivo não encontrado.'
            ], 403);
        }

        $caminho = 'public/arquivos/' . $arquivo_file->arquivo_id . '/' . 
            $arquivo_file->nome_arquivo;

        return Storage::download($caminho);
    }
}
