<?php

namespace App\Http\Controllers;

use App\Models\membros;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class membroController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /membros
     */
    public function index(Request $request = null)
    {

        $request = $request ?: request();

        $query = membros::query();

        if (filled($request->situacao)) {
            if ($request->situacao == 'all') {
                $membros = $query->with('user')->orderby('id', 'desc')->get();
                return view('gerir.membros', compact('membros'));
            }

            $query->where('situacao', $request->situacao);
        }
        if (filled($request->nome)) {
            $query->where('nome', '%' . $request->nome . '%');
        }

        $membros = $query->with('user')->orderby('id', 'desc')->get();


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
            'email' => 'required|string|max:255',
            'estado_civil' => 'required|in:Solteiro,Casado,Viuvo,Divorciado',
            'genero' => 'required|in:M,F',
            'telefone' => 'required|string|max:20',
            'data_nascimento' => 'required|date',
            'data_batismo' => 'nullable|date',
            'situacao' => 'required|in:Activo,Inativo,Transferido',
            //'cargo' => 'nullable|string|max:100',
            'user_id' => 'nullable',
        ]);


        // dd($request->all());

        $validated['user_id'] = Auth::user()->id;

        membros::create($validated);
        alert($validated['nome'], 'Membro criado com sucesso!', 'success');
        return redirect()->route('membro.index');
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
            'email' => 'required|string|max:255',
            'estado_civil' => 'required|in:Solteiro,Casado,Viúvo,Divorciado',
            'genero' => 'required|in:M,F',
            'telefone' => 'required|string|max:20',
            'data_nascimento' => 'required|date',
            'data_batismo' => 'nullable|date',
            'situacao' => 'required|in:Activo,Inativo,Transferido',


        ]);

        $membro->update([
            'nome' => $validated['nome'],
            'morada' => $validated['morada'],
            'email' => $validated['email'],
            'estado_civil' => $validated['estado_civil'],
            'genero' => $validated['genero'],
            'telefone' => $validated['telefone'],
            'data_nascimento' => $validated['data_nascimento'],
            'data_batismo' => $validated['data_batismo'],
            'situacao' => $validated['situacao'],
            'user_id' => Auth::user()->id
        ]);

        alert($validated['nome'], 'Membro atualizado com sucesso!', 'success');
        return redirect()->route('membro.index');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /membros/{id}
     */
    public function destroy(membros $membro)
    {
        $membro->delete();
        alert($membro['nome'], 'Membro deletado com sucesso!', 'info');
        return redirect()->route('membro.index');
    }
}
