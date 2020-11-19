<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends BaseController
{
    public function index()
    {
        return Usuario::all();
    }

    public function detalhar(Usuario $usuario)
    {
        return $usuario;
    }

    public function cadastrar(Request $request)
    {
        $dados = $request->all();
        $validador = Validator::make($dados, [
            'user_nome' => 'required',
            'user_email' => 'required|email',
            'user_senha' => 'required',
            'compara_senha' => 'required|same:user_senha',
            'user_permissao' => 'required|integer'
        ]);
        if ($validador->fails()) {
            return $this->sendError('VErro de validação: ', $validator->errors());
        }
        unset($dados['compara_senha']);
        $dados['user_senha'] = Hash::make($dados['user_senha']);
        $usuario = Usuario::create($dados);
        $auth['token'] = $usuario->createToken('App')->accessToken;
        $auth['name'] = $usuario->user_nome;
        return $this->sendResponse($auth, 'Usuário cadastrado com sucesso.');
    }

    public function editar(Request $request, Usuario $usuario)
    {
        $usuario->update($request->all());
        return response()->json($usuario);
    }

    public function remover(Usuario $usuario)
    {
        $usuario->delete();
        return response()->json(null, 204);
    }

    public function autenticar(Request $request)
    {
        if (Auth::attempt(['user_email' => $request->email, 'user_senha' => $request->senha])) {
            $usuario = Auth::user();
            $auth['token'] = $usuario->createToken('App')->accessToken;
            $auth['name'] = $usuario->user_nome;
            return $this->sendResponse($auth, 'Usuário autenticado com sucesso.');
        } else {
            return $this->sendError('Não autorizado.', ['error'=>'Unauthorised']);
        }
    }
}
