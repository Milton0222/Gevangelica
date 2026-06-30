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
        $usuarios = User::orderby('created_at', 'DESC')->get();
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

    public function desabilitar($id){

        $usuario = User::findorfail($id);

        if(Auth::user()->isAdmin){
            $usuario->update([
                'isPastar' => 0,
                'isAdmin' => 0,
                'isSecretario' => 0,
                'isMembro' => 0,
                'isTesoureiro' => 0,
                'isLider'=>0

            ]);
            alert(Auth::user()->name,'Conta desabilitada','info');
        }
        return redirect()->route('usuario.index');

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
        ]);

        //  dd($request->all());

        if ($request->isPastor == 'on') {

            User::create([
                'name' => $validated['name'],
                'email' => strtolower($validated['email']),
                'password' => bcrypt(123456789),
                'isPastar' => 1,
                'isAdmin' => 1
            ]);
            alert($validated['name'], 'Usuário criado com sucesso como Pastor!', 'success');
        } elseif ($request->isSecretario == 'on') {
            User::create([
                'name' => $validated['name'],
                'email' => strtolower($validated['email']),
                'password' => bcrypt(123456789),
                'isSecretario' => 1
            ]);
            alert($validated['name'], 'Usuário criado com sucesso como Secretario(a)!', 'success');
        } elseif ($request->isMembro == 'on') {
            User::create([
                'name' => $validated['name'],
                'email' => strtolower($validated['email']),
                'password' => bcrypt(123456789),
                'isMembro' => 1
            ]);
            alert($validated['name'], 'Usuário criado com sucesso como Membro!', 'success');
        } elseif ($request->isLider == 'on') {
            User::create([
                'name' => $validated['name'],
                'email' => strtolower($validated['email']),
                'password' => bcrypt(123456789),
                'isLider' => 1
            ]);
            alert($validated['name'], 'Usuário criado com sucesso como Lider!', 'success');
        } elseif ($request->isTesoureiro == 'on') {
            User::create([
                'name' => $validated['name'],
                'email' => strtolower($validated['email']),
                'password' => bcrypt(123456789),
                'isTesoureiro' => 1
            ]);
            alert($validated['name'], 'Usuário criado com sucesso como Tesoureiro!', 'success');
        } else {
            alert(Auth::user()->name, 'Selecionar um tipo de conta', 'info');
        }
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
        ]);
//dd($usuario);
        if ($request->isPastor == 'on') {

            $usuario->update([
                'name' => $validated['name'],
                'email' => strtolower($validated['email']),
                'isPastar' => 1,
                'isAdmin' => 1,
                'isSecretario' => 0,
                'isMembro' => 0,
                'isTesoureiro' => 0,
                'isLider'=>0
            ]);
        } elseif ($request->isSecretario == 'on') {
            $usuario->update([
                'name' => $validated['name'],
                'email' => strtolower($validated['email']),
                'isPastar' => 0,
                'isAdmin' => 0,
                'isSecretario' => 1,
                'isMembro' => 0,
                'isTesoureiro' => 0,
                'isLider'=>0
            ]);
        } elseif ($request->isMembro == 'on') {
            $usuario->update([
                'name' => $validated['name'],
                'email' => strtolower($validated['email']),
                'isPastar' => 0,
                'isAdmin' => 0,
                'isSecretario' => 0,
                'isMembro' => 1,
                'isTesoureiro' => 0,
                'isLider'=>0
            ]);
        } elseif ($request->isLider == 'on') {
            $usuario->update([
                'name' => $validated['name'],
                'email' => strtolower($validated['email']),
                'isPastar' => 0,
                'isAdmin' => 0,
                'isSecretario' => 0,
                'isMembro' => 0,
                'isTesoureiro' => 0,
                'isLider'=>1
            ]);
        } elseif ($request->isTesoureiro == 'on') {
            $usuario->update([
                'name' => $validated['name'],
                'email' => strtolower($validated['email']),
                'isPastar' => 0,
                'isAdmin' => 0,
                'isSecretario' => 0,
                'isMembro' => 0,
                'isTesoureiro' => 1,
                'isLider'=>0
            ]);
        } else {
            alert(Auth::user()->name, 'Selecionar um tipo de conta', 'info');
        }

        alert($usuario['name'], 'Usuário atualizado com sucesso!', 'success');
        return redirect()->route('usuario.index');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /usuarios/{id}
     */
    public function destroy(User $usuario)
    {
        if (Auth::user()->isAdmin) {
            $usuario->delete();
            alert($usuario['name'], 'Utilizador apagado com sucesso.', 'success');
        } else {
            alert(Auth::user()->name, 'Utilizador sem permissão', 'info');
        }
        return redirect()->route('usuario.index')->with('success', 'Usuário deletado com sucesso!');
    }
}
