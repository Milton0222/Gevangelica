<?php

namespace App\Http\Controllers;

use App\Models\classes;
use App\Models\eventos;
use App\Models\membros;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClasseController extends Controller
{
    /**
     * Exibe a lista de todas as classes.
     * GET /classes
     */
    public function index(Request $request = null)
    {
        $request = $request ?: request();

        $query = classes::query();

        if ($request->filled('grupo')) {
            $query->where('grupo', 'LIKE', '%' . $request->grupo . '%');
        }
        if ($request->filled('frequencia')) {

            if ($request->frequencia == 'all') {

                $classes = $query->with(['evento', 'professor'])->get();
                $eventos = eventos::all();
                $professores = membros::whereNotNull('id')->orderby('id', 'desc')->get();
                return view('gerir.classes', compact('classes', 'professores', 'eventos'));
            }
            $query->where('frequencia', $request->frequencia);
        }

        $classes = $query->with(['evento', 'professor'])->get();

        $eventos = eventos::all();
        $professores = membros::whereNotNull('id')->orderby('id', 'desc')->get();
        return view('gerir.classes', compact('classes', 'professores', 'eventos'));
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

        if (classes::create($validated)) {
            alert(Auth::user()->name, 'Classe criada com sucesso, selecione os membros !', 'success');
        }
        return redirect()->route('classe.index');
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
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'grupo' => 'required|string|max:100',
            'frequencia' => 'required|in:diária,semanal,mensal,trimestral',
            'evento_id' => 'required|exists:eventos,id',
            'professor_id' => 'required|exists:users,id',
        ]);

        $classe = classes::find($id);
        if ($classe->update($validated)) {
            alert(Auth::user()->name, 'Classe atualizada com sucesso!', 'success');
        }
        return redirect()->route('classe.index');
    }

    /**
     * Remove uma classe do banco de dados.
     * DELETE /classes/{id}
     */
    public function destroy($id)
    {
        $classe = classes::find($id);

        if ($classe->delete()) {
            alert(Auth::user()->name, 'Classe deletada com sucesso!', 'success');
        }
        return redirect()->route('classe.index');
    }
}
