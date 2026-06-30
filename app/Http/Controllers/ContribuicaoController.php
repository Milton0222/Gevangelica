<?php

namespace App\Http\Controllers;

use App\Models\contribuicoes;
use App\Models\membros;
use App\Models\User;
use Illuminate\Http\Request;

class ContribuicaoController extends Controller
{
    /**
     * Exibe a lista de todas as contribuições.
     * GET /contribuicoes
     */
    public function index()
    {
        $contribuicoes = contribuicoes::with(['membro', 'usuario'])->paginate(15);
        return view('gerir.contribuicoes', compact('contribuicoes'));
    }

    /**
     * Exibe o formulário para criar uma nova contribuição.
     * GET /contribuicoes/create
     */
    public function create()
    {
        $membros = membros::all();
        $usuarios = User::all();
        return view('gerir.contribuicoes_create', compact('membros', 'usuarios'));
    }

    /**
     * Armazena uma nova contribuição no banco de dados.
     * POST /contribuicoes
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo' => 'required|in:dízimo,oferta,doação,subscrição',
            'obs' => 'nullable|string|max:500',
            'valor' => 'required|numeric|min:0.01',
            'membro_id' => 'required|exists:membros,id',
            'user_id' => 'required|exists:users,id',
        ]);

        contribuicoes::create($validated);
        return redirect()->route('contribuicao.index')->with('success', 'Contribuição registrada com sucesso!');
    }

    /**
     * Exibe os detalhes de uma contribuição específica.
     * GET /contribuicoes/{id}
     */
    public function show(contribuicoes $contribuicao)
    {
        $contribuicao->load(['membro', 'usuario']);
        return view('gerir.contribuicoes_show', compact('contribuicao'));
    }

    /**
     * Exibe o formulário para editar uma contribuição.
     * GET /contribuicoes/{id}/edit
     */
    public function edit(contribuicoes $contribuicao)
    {
        $membros = membros::all();
        $usuarios = User::all();
        return view('gerir.contribuicoes_edit', compact('contribuicao', 'membros', 'usuarios'));
    }

    /**
     * Atualiza uma contribuição no banco de dados.
     * PUT /contribuicoes/{id}
     */
    public function update(Request $request, contribuicoes $contribuicao)
    {
        $validated = $request->validate([
            'tipo' => 'required|in:dízimo,oferta,doação,subscrição',
            'obs' => 'nullable|string|max:500',
            'valor' => 'required|numeric|min:0.01',
            'membro_id' => 'required|exists:membros,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $contribuicao->update($validated);
        return redirect()->route('contribuicao.index')->with('success', 'Contribuição atualizada com sucesso!');
    }

    /**
     * Remove uma contribuição do banco de dados.
     * DELETE /contribuicoes/{id}
     */
    public function destroy(contribuicoes $contribuicao)
    {
        $contribuicao->delete();
        return redirect()->route('contribuicao.index')->with('success', 'Contribuição deletada com sucesso!');
    }
}
