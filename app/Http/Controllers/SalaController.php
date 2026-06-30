<?php

namespace App\Http\Controllers;

use App\Models\salas;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    /**
     * Exibe a lista de todas as salas.
     * GET /salas
     */
    public function index()
    {
        $salas = salas::paginate(15);
        return view('gerir.salas', compact('salas'));
    }

    /**
     * Exibe o formulário para criar uma nova sala.
     * GET /salas/create
     */
    public function create()
    {
        return view('gerir.salas_create');
    }

    /**
     * Armazena uma nova sala no banco de dados.
     * POST /salas
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'n_sala' => 'required|string|max:50|unique:salas',
            'estado' => 'required|in:disponível,ocupada,manutenção',
        ]);

        salas::create($validated);
        return redirect()->route('sala.index')->with('success', 'Sala criada com sucesso!');
    }

    /**
     * Exibe os detalhes de uma sala específica.
     * GET /salas/{id}
     */
    public function show(salas $sala)
    {
        $sala->load('departamentos');
        return view('gerir.salas_show', compact('sala'));
    }

    /**
     * Exibe o formulário para editar uma sala.
     * GET /salas/{id}/edit
     */
    public function edit(salas $sala)
    {
        return view('gerir.salas_edit', compact('sala'));
    }

    /**
     * Atualiza uma sala no banco de dados.
     * PUT /salas/{id}
     */
    public function update(Request $request, salas $sala)
    {
        $validated = $request->validate([
            'n_sala' => 'required|string|max:50|unique:salas,n_sala,' . $sala->id,
            'estado' => 'required|in:disponível,ocupada,manutenção',
        ]);

        $sala->update($validated);
        return redirect()->route('sala.index')->with('success', 'Sala atualizada com sucesso!');
    }

    /**
     * Remove uma sala do banco de dados.
     * DELETE /salas/{id}
     */
    public function destroy(salas $sala)
    {
        $sala->delete();
        return redirect()->route('sala.index')->with('success', 'Sala deletada com sucesso!');
    }
}
