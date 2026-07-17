<?php

namespace App\Http\Controllers;

use App\Models\departamentos;
use App\Models\eventos;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Exibe a lista de todos os eventos.
     * GET /eventos
     */
    public function index(Request $request = null)
    {

        $request = $request ?: request();

        $query = eventos::query();

          if(filled($request->data)){
               $query->where('data',$request->data);
          }
        $eventos = $query->orderby('created_at','desc')->get();

        $departamentos = departamentos::get();
        return view('gerir.eventos', compact('eventos', 'departamentos'));
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
            'estado' => 'required|in:Pendente,Realizado,Cancelado',
            'finalidade' => 'nullable|string|max:500',
            'tema' => 'nullable|string|max:255',
            'depa_id' => 'required|integer'
        ]);
        if ($depa = departamentos::find($request->depa_id)) {
            if (eventos::create($validated)) {
                alert($validated['nome'], 'Evento criado com sucesso!', 'success');
            }
        } else {
            alert($validated['nome'], 'Evento não criado com sucesso, verificar departamento!', 'success');
        }
        return redirect()->route('evento.index');
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
        // dd($request->all());
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:100',
            'data' => 'required|date',
            'local' => 'required|string|max:255',
            'hora' => 'required|date_format:H:i',
            'estado' => 'required|in:Pendente,Realizado,Cancelado',
            'finalidade' => 'nullable|string|max:500',
            'tema' => 'nullable|string|max:255',
            'depa_id' => 'required|integer'
        ]);

        if ($evento->update($validated)) {
            alert($validated['nome'], 'Evento atualizado com sucesso!', 'success');
        }
        return redirect()->route('evento.index');
    }

    /**
     * Remove um evento do banco de dados.
     * DELETE /eventos/{id}
     */
    public function destroy(eventos $evento)
    {
        if ($evento->delete()) {
            alert($evento['nome'], 'Evento deletado com sucesso!', 'info');
        }
        return redirect()->route('evento.index');
    }
}
