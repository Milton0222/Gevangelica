<?php

namespace App\Http\Controllers;

use App\Models\classes;
use App\Models\eventos;
use App\Models\User;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Exibe a lista de todas as classes.
     * GET /classes
     */
    public function index()
    {
        $classes = classes::with(['evento', 'professor'])->paginate(15);
        return view('gerir.classes', compact('classes'));
    }

    /**
     * Exibe o formulário para criar uma nova classe.
     * GET /classes/create
     */
    public function create()
    {
        $eventos = eventos::all();
        $professores = User::whereNotNull('id')->get();
        return view('gerir.classes_create', compact('eventos', 'professores'));
    }

    /**
     * Armazena uma nova classe no banco de dados.
     * POST /classes
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'grupo' => 'required|string|max:100',
            'frequencia' => 'required|in:diária,semanal,mensal,trimestral',
            'evento_id' => 'required|exists:eventos,id',
            'professor_id' => 'required|exists:users,id',
        ]);

        classes::create($validated);
        return redirect()->route('classe.index')->with('success', 'Classe criada com sucesso!');
    }

    /**
     * Exibe os detalhes de uma classe específica.
     * GET /classes/{id}
     */
    public function show(classes $classe)
    {
        $classe->load(['evento', 'professor', 'membros']);
        return view('gerir.classes_show', compact('classe'));
    }

    /**
     * Exibe o formulário para editar uma classe.
     * GET /classes/{id}/edit
     */
    public function edit(classes $classe)
    {
        $eventos = eventos::all();
        $professores = User::all();
        return view('gerir.classes_edit', compact('classe', 'eventos', 'professores'));
    }

    /**
     * Atualiza uma classe no banco de dados.
     * PUT /classes/{id}
     */
    public function update(Request $request, classes $classe)
    {
        $validated = $request->validate([
            'grupo' => 'required|string|max:100',
            'frequencia' => 'required|in:diária,semanal,mensal,trimestral',
            'evento_id' => 'required|exists:eventos,id',
            'professor_id' => 'required|exists:users,id',
        ]);

        $classe->update($validated);
        return redirect()->route('classe.index')->with('success', 'Classe atualizada com sucesso!');
    }

    /**
     * Remove uma classe do banco de dados.
     * DELETE /classes/{id}
     */
    public function destroy(classes $classe)
    {
        $classe->delete();
        return redirect()->route('classe.index')->with('success', 'Classe deletada com sucesso!');
    }
}
