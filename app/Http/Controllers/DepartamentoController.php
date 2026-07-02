<?php

namespace App\Http\Controllers;

use App\Models\departamentos;
use App\Models\membros;
use App\Models\User;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /**
     * Exibe a lista de todos os departamentos.
     * GET /departamentos
     */
    public function index(Request $request = null)
    {

        $request = $request ?: request();

        $query = departamentos::query();

        if (filled($request->nome)) {
            $query->where('nome','LIKE', '%' . $request->nome . '%');
        }
        if (filled($request->lider)) {

            if ($request->lider == 'all') {
                $departamentos = $query->with('lider')->paginate(15);

                $lideres = membros::orderby('id', 'desc')->get();
                return view('gerir.departamentos', compact('departamentos', 'lideres'));
            }
            $query->where('lider_id', $request->lider);
        }

        $departamentos = $query->with('lider')->paginate(15);

        $lideres = membros::orderby('id', 'desc')->get();
        return view('gerir.departamentos', compact('departamentos', 'lideres'));
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
            'lider_id' => 'required|exists:membros,id',
        ]);

        departamentos::create($validated);
        alert($validated['nome'], 'Departamento criado com sucesso!', 'success');
        return redirect()->route('departamento.index');
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
            'lider_id' => 'required|exists:membros,id',
        ]);

        $departamento->update($validated);
        alert($departamento['nome'], 'Departamento atualizado com sucesso!', 'info');
        return redirect()->route('departamento.index');
    }

    /**
     * Remove um departamento do banco de dados.
     * DELETE /departamentos/{id}
     */
    public function destroy(departamentos $departamento)
    {
        $departamento->delete();
        alert($departamento['nome'], 'Departamento deletado com sucesso!', 'info');
        return redirect()->route('departamento.index');
    }
}
