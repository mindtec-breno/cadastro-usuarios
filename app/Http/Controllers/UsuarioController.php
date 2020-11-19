<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
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
        $usuario = Usuario::create($request->all());
        return response()->json($usuario, 201);
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
}
