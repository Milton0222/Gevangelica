<?php

namespace App\Http\Controllers;

use App\Models\contribuicoes;
use App\Models\membros;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContribuicaoController extends Controller
{
    /**
     * Exibe a lista de todas as contribuições.
     * GET /contribuicoes
     */
    public function index(Request $request=null)
    {

    $request=$request?: request();

    $query=contribuicoes::query();


            if($request->filled('data')){
                 $query->wheredate('created_at', $request->data);
            }
            if($request->filled('tipo')){
                   if($request->tipo=='all'){
                      $contribuicoes = $query->with(['membro', 'usuario'])->get();


        $membros = membros::all();
        $usuarios = User::all();
        return view('gerir.contribuicoes', compact('contribuicoes','membros', 'usuarios'));

                   }
                   $query->where('tipo', $request->tipo);
            }

        $contribuicoes = $query->with(['membro', 'usuario'])->get();


        $membros = membros::all();
        $usuarios = User::all();
        return view('gerir.contribuicoes', compact('contribuicoes','membros', 'usuarios'));
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
            'tipo' => 'required|in:Dizimo,Oferta,doação,subscrição',
            'obs' => 'nullable|string|max:500',
            'valor' => 'required|numeric|min:0.01',
            'membro_id' => 'required|exists:membros,id',
            'user_id' => 'required|exists:users,id',
        ]);

           if(contribuicoes::create($validated)){
               alert(Auth::user()->name,'Contribuição do tipo '.$validated['tipo'].' registada!','success');
           }
        return redirect()->route('contribuicao.index');
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
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tipo' => 'required|in:Dizimo,Oferta,doação,subscrição',
            'obs' => 'nullable|string|max:500',
            'valor' => 'required|numeric|min:0.01',
            'membro_id' => 'required|exists:membros,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $contribuicao=contribuicoes::find($id);

        if($contribuicao->update($validated)){
            alert(Auth::user()->name,'Contribuição do tipo '.$validated['tipo'].' dados actualizados!','success');
        }
        return redirect()->route('contribuicao.index');
    }

    /**
     * Remove uma contribuição do banco de dados.
     * DELETE /contribuicoes/{id}
     */
    public function destroy($id)
    {
           $contribuicao=contribuicoes::find($id);
                $verificar=$contribuicao->delete();
         if( $verificar){
            alert(Auth::user()->name,'Contribuição do tipo '.$contribuicao['tipo'].' dados apagados!','success');
         }
        return redirect()->route('contribuicao.index')->with('success', 'Contribuição deletada com sucesso!');
    }
}
