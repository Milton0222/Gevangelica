<?php

namespace App\Http\Controllers;

use App\Models\departamentos;
use App\Models\User;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /**
     * Exibe a lista de todos os departamentos.
     * GET /departamentos
     */
    public function index()
    {
        $departamentos = departamentos::with('lider')->paginate(15);
        return view('gerir.departamentos', compact('departamentos'));
    }

    /**
     * Exibe o formulário para criar um novo departamento.
     * GET /departamentos/create
     */
    public function create()
    {
        $lideres = User::all();
        return view('gerir.departamentos_create', compact('lideres'));
    }

    /**
     * Armazena um novo departamento no banco de dados.
     * POST /departamentos
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255|unique:departamentos',
            'lider_id' => 'required|exists:users,id',
        ]);

        departamentos::create($validated);
        return redirect()->route('departamento.index')->with('success', 'Departamento criado com sucesso!');
    }

    /**
     * Exibe os detalhes de um departamento específico.
     * GET /departamentos/{id}
     */
    public function show(departamentos $departamento)
    {
        $departamento->load(['lider', 'salas']);
        return view('gerir.departamentos_show', compact('departamento'));
    }

    /**
     * Exibe o formulário para editar um departamento.
     * GET /departamentos/{id}/edit
     */
    public function edit(departamentos $departamento)
    {
        $lideres = User::all();
        return view('gerir.departamentos_edit', compact('departamento', 'lideres'));
    }

    /**
     * Atualiza um departamento no banco de dados.
     * PUT /departamentos/{id}
     */
    public function update(Request $request, departamentos $departamento)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255|unique:departamentos,nome,' . $departamento->id,
            'lider_id' => 'required|exists:users,id',
        ]);

        $departamento->update($validated);
        return redirect()->route('departamento.index')->with('success', 'Departamento atualizado com sucesso!');
    }

    /**
     * Remove um departamento do banco de dados.
     * DELETE /departamentos/{id}
     */
    public function destroy(departamentos $departamento)
    {
        $departamento->delete();
        return redirect()->route('departamento.index')->with('success', 'Departamento deletado com sucesso!');
    }
}
