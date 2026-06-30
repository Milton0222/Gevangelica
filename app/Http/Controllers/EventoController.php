<?php

namespace App\Http\Controllers;

use App\Models\eventos;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Exibe a lista de todos os eventos.
     * GET /eventos
     */
    public function index()
    {
        $eventos = eventos::paginate(15);
        return view('gerir.eventos', compact('eventos'));
    }

    /**
     * Exibe o formulário para criar um novo evento.
     * GET /eventos/create
     */
    public function create()
    {
        return view('gerir.eventos_create');
    }

    /**
     * Armazena um novo evento no banco de dados.
     * POST /eventos
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:100',
            'data' => 'required|date',
            'local' => 'required|string|max:255',
            'hora' => 'required|date_format:H:i',
            'estado' => 'required|in:planejado,em_andamento,finalizado,cancelado',
            'finalidade' => 'nullable|string|max:500',
            'tema' => 'nullable|string|max:255',
        ]);

        eventos::create($validated);
        return redirect()->route('evento.index')->with('success', 'Evento criado com sucesso!');
    }

    /**
     * Exibe os detalhes de um evento específico.
     * GET /eventos/{id}
     */
    public function show(eventos $evento)
    {
        $evento->load('classes');
        return view('gerir.eventos_show', compact('evento'));
    }

    /**
     * Exibe o formulário para editar um evento.
     * GET /eventos/{id}/edit
     */
    public function edit(eventos $evento)
    {
        return view('gerir.eventos_edit', compact('evento'));
    }

    /**
     * Atualiza um evento no banco de dados.
     * PUT /eventos/{id}
     */
    public function update(Request $request, eventos $evento)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:100',
            'data' => 'required|date',
            'local' => 'required|string|max:255',
            'hora' => 'required|date_format:H:i',
            'estado' => 'required|in:planejado,em_andamento,finalizado,cancelado',
            'finalidade' => 'nullable|string|max:500',
            'tema' => 'nullable|string|max:255',
        ]);

        $evento->update($validated);
        return redirect()->route('evento.index')->with('success', 'Evento atualizado com sucesso!');
    }

    /**
     * Remove um evento do banco de dados.
     * DELETE /eventos/{id}
     */
    public function destroy(eventos $evento)
    {
        $evento->delete();
        return redirect()->route('evento.index')->with('success', 'Evento deletado com sucesso!');
    }
}
