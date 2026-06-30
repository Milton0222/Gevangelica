<?php

namespace App\Http\Controllers;

use App\Models\membros;
use App\Models\User;
use Illuminate\Http\Request;

class membroController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /membros
     */
    public function index()
    {
        $membros = membros::with('user')->paginate(15);
        return view('gerir.membros', compact('membros'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /membros/create
     */
    public function create()
    {
        $users = User::all();
        return view('gerir.membros_create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /membros
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'morada' => 'required|string|max:255',
            'estado_civil' => 'required|in:solteiro,casado,viúvo,divorciado',
            'genero' => 'required|in:masculino,feminino',
            'telefone' => 'required|string|max:20',
            'data_nascimento' => 'required|date',
            'data_batismo' => 'nullable|date',
            'situcao' => 'required|in:ativo,inativo,afastado',
            'cargo' => 'nullable|string|max:100',
            'user_id' => 'nullable|exists:users,id',
        ]);

        membros::create($validated);
        return redirect()->route('membro.index')->with('success', 'Membro criado com sucesso!');
    }

    /**
     * Display the specified resource.
     * GET /membros/{id}
     */
    public function show(membros $membro)
    {
        $membro->load(['user', 'contribuicoes', 'classes']);
        return view('gerir.membros_show', compact('membro'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /membros/{id}/edit
     */
    public function edit(membros $membro)
    {
        $users = User::all();
        return view('gerir.membros_edit', compact('membro', 'users'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /membros/{id}
     */
    public function update(Request $request, membros $membro)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'morada' => 'required|string|max:255',
            'estado_civil' => 'required|in:solteiro,casado,viúvo,divorciado',
            'genero' => 'required|in:masculino,feminino',
            'telefone' => 'required|string|max:20',
            'data_nascimento' => 'required|date',
            'data_batismo' => 'nullable|date',
            'situcao' => 'required|in:ativo,inativo,afastado',
            'cargo' => 'nullable|string|max:100',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $membro->update($validated);
        return redirect()->route('membro.index')->with('success', 'Membro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /membros/{id}
     */
    public function destroy(membros $membro)
    {
        $membro->delete();
        return redirect()->route('membro.index')->with('success', 'Membro deletado com sucesso!');
    }
}
