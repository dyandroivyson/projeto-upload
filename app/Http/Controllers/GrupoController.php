<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grupo;

class GrupoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cadastrar(Request $request)
    {
        if (!isset($request->grupo_nome) && is_null($request->grupo_nome)) {
            return response()->json([
                'msg' => 'Nome do grupo é obrigatório!'
            ], 403);
        }

        if (Grupo::where('grupo_nome', $request->grupo_nome)->first()) {
            return response()->json([
                'msg' => 'Nome do grupo já está sendo utilizado.'
            ], 403);
        }

        Grupo::create($request->all());

        return response()->json([
            'msg' => 'Grupo cadastrado com sucesso!'
        ], 201);
    }

    public function listar()
    {
        return response()->json(
            Grupo::get()->pluck('grupo_nome', 'grupo_id')
        , 200);
    }
}
