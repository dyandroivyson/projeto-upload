<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grupo;
use App\User;
use Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cadastrar(Request $request)
    {
        if (!isset($request->name) && is_null($request->name)) {
            return response()->json([
                'msg' => 'Nome do usuário é obrigatório!'
            ], 403);
        }

        if (!isset($request->email) && is_null($request->email)) {
            return response()->json([
                'msg' => 'Email é obrigatório!'
            ], 403);
        }

        if (!isset($request->password) && is_null($request->password)) {
            return response()->json([
                'msg' => 'Senha é obrigatória!'
            ], 403);
        }

        if (!isset($request->grupo_id) && is_null($request->grupo_id)) {
            return response()->json([
                'msg' => 'Grupo é obrigatório!'
            ], 403);
        }

        if (User::where('email', $request->email)->first()) {
            return response()->json([
                'msg' => 'E-mail já está sendo utilizado.'
            ], 403);
        }

        if (!Grupo::find($request->grupo_id)) {
            return response()->json([
                'msg' => 'Grupo informado não existe.'
            ], 403);
        }

        $user = $request->all();
        $user['password'] = Hash::make($user['password']);

        User::create($user);

        return response()->json([
            'msg' => 'Usuário cadastrado com sucesso!'
        ], 201);
    }

    public function listar()
    {
        return response()->json(
            User::get()->pluck('name', 'id')
        , 200);
    }
}
