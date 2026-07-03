<?php

namespace App\Http\Controllers;

use App\Models\departamentos;
use App\Models\salas;
use App\Models\salas_departamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class aluguerController extends Controller
{
    //

    function index()
    {


        $salas = salas::get();

        $departamentos = departamentos::get();

        $alugueres = salas_departamentos::orderby('created_at', 'desc')->get();



        return view('gerir.aluguer', compact('salas', 'departamentos', 'alugueres'));
    }

    function store(Request $request)
    {
        $validated = $request->validate([
            'sala_id' => 'required|integer|exists:salas,id',
            'depa_id' => 'required|integer|exists:departamentos,id',
            'hora_inicio' => 'required',
            'hora_fim' => 'required',
            'data' => 'required|date',
            'finalidade' => 'required'
        ]);

        salas_departamentos::create($validated);

        //atualizar estado da sala 
        $sala = salas::findorfail($validated['sala_id']);
        $sala->update([
            'estado' => 'Reservado'
        ]);

        alert(Auth::user()->name, 'Sala rservada, verificar a lista a baixo!', 'info');

        return redirect()->route('alugueres.index');
    }

    function update(Request $request, $id)
    {
        dd($request->all());
    }

    function destroy($sala, $depa)
    {
       // dd($sala, $depa);

        $sql = "DELETE FROM salas_departamentos WHERE sala_id=$sala AND depa_id=$depa;";

        DB::select($sql);

            $sala = salas::findorfail($sala);
            //mudar estado

            $sala->update([
                'estado' => 'Livre'
            ]);

            alert(Auth::user()->name, 'Aluguer de Sala eliminado!', 'info');
        

        return redirect()->route('alugueres.index');
    }
}
