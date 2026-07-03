<?php

namespace App\Http\Controllers;

use App\Models\salas;
use App\Models\salas_departamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalaController extends Controller
{
    /**
     * Exibe a lista de todas as salas.
     * GET /salas
     */
    public function index(Request $request = null)
    {

        $request = $request ?: request();

        $query = salas::query();

        if (filled($request->sala)) {
            $query->where('n_sala', $request->sala);
        }
        if (filled($request->estado)) {
            if ($request->estado == 'all') {
                $salas = $query->paginate(15);
                return view('gerir.salas', compact('salas'));
            }
            $query->where('estado',$request->estado);
        }
        $salas = $query->paginate(15);
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
            'n_sala' => 'required|unique:salas',
        ]);

        if (salas::where('n_sala', $validated['n_sala'])->first()) {
            alert($validated['n_sala'], 'Ja Foi registada, verificar identificador na porta.', 'info');
        } else {
            salas::create([
                'n_sala' => $validated['n_sala'],
                'estado' => 'Livre',
                'user_id' => Auth::user()->id

            ]);
            alert($validated['n_sala'], 'Sala criada com sucesso!', 'success');
        }
        return redirect()->route('sala.index');
    }

    /**
     * Exibe os detalhes de uma sala específica.
     * GET /salas/{id}
     */
    public function show(salas $sala)
    {
        $sala->load('departamentos');
          
        $historico=salas_departamentos::where('sala_id',$sala['id'])->orderby('created_at','desc')->get();

        return view('gerir.salas_show', compact('sala','historico'));
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
            'estado' => 'required|in:Reservado,Livre,Pendente',
        ]);

        $sala->update($validated);
        alert($sala['n_sala'], 'Sala atualizada com sucesso!', 'info');
        return redirect()->route('sala.index');
    }

    /**
     * Remove uma sala do banco de dados.
     * DELETE /salas/{id}
     */
    public function destroy(salas $sala)
    {
        $sala->delete();
        alert($sala['n_sala'], 'Sala deletada com sucesso!', 'info');
        return redirect()->route('sala.index');
    }
}
