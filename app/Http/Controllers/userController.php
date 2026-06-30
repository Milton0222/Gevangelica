<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /usuarios
     */
    public function index()
    {
        $usuarios = User::orderby('created_at','DESC')->get();
        return view('gerir.user', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /usuarios/create
     */
    public function create()
    {
        return view('gerir.user_create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /usuarios
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'isPastor' => 'boolean',
            'isAdmin' => 'boolean',
            'isSecretario' => 'boolean',
            'isLider' => 'boolean',
            'isTesoureiro' => 'boolean',
            'isMembro' => 'boolean',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);
        alert($validated['name'],'Usuário criado com sucesso!','success');
        return redirect()->route('usuario.index');
    }

    /**
     * Display the specified resource.
     * GET /usuarios/{id}
     */
    public function show(User $usuario)
    {
        $usuario->load(['membro', 'contribuicoes', 'classes', 'departamentos']);
        return view('gerir.user_show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /usuarios/{id}/edit
     */
    public function edit(User $usuario)
    {
        return view('gerir.user_edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /usuarios/{id}
     */
    public function update(Request $request, User $usuario)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            'password' => 'nullable|string|min:8|confirmed',
            'isPastor' => 'boolean',
            'isAdmin' => 'boolean',
            'isSecretario' => 'boolean',
            'isLider' => 'boolean',
            'isTesoureiro' => 'boolean',
            'isMembro' => 'boolean',
        ]);

        if ($validated['password'] ?? null) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $usuario->update($validated);
        alert($usuario['name'],'Usuário atualizado com sucesso!','success');
        return redirect()->route('usuario.index');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /usuarios/{id}
     */
    public function destroy(User $usuario)
    {
        if(Auth::user()->isAdmin){
                    $usuario->delete();
            alert($usuario['name'],'Utilizador apagado com sucesso.','success');
        }else{
            alert(Auth::user()->name,'Utilizador sem permissão','info');
        }
        return redirect()->route('usuario.index')->with('success', 'Usuário deletado com sucesso!');
    }
}
