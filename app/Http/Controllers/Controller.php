<?php

namespace App\Http\Controllers;

use App\Models\eventos;
use App\Models\membros;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function index()
    {

    if(Auth::user()->isAdmin==0 && Auth::user()->isPastar==0 && Auth::user()->isMembro==0 && Auth::user()->isSecretario==0 && Auth::user()->isTesoureiro==0 && Auth::user()->isLider==0)
        return view('desabilitado');


    //dados estatisticos

    $membros_c=membros::count();
    $membros_a=membros::where('situacao','Activo')->count();
    $f=membros::where('genero','F')->count();
    $m=membros::where('genero','M')->count();

    $inicio = now()->startOfMonth()->subMonths(5);
    $meses = collect(range(0, 5))->map(
        fn ($offset) => $inicio->copy()->addMonths($offset)
    );
    $cadastrosPorMes = membros::whereBetween('created_at', [$inicio, now()])
        ->get(['created_at'])
        ->countBy(fn ($membro) => $membro->created_at->format('Y-m'));
    $nomesDosMeses = [
        1 => 'Jan', 2 => 'Fev', 3 => 'Mar', 4 => 'Abr',
        5 => 'Mai', 6 => 'Jun', 7 => 'Jul', 8 => 'Ago',
        9 => 'Set', 10 => 'Out', 11 => 'Nov', 12 => 'Dez',
    ];
    $growthLabels = $meses->map(
        fn ($mes) => $nomesDosMeses[$mes->month].'/'.$mes->format('y')
    )->all();
    $growthData = $meses->map(
        fn ($mes) => $cadastrosPorMes->get($mes->format('Y-m'), 0)
    )->all();

    $ageData = [
        'Crianças' => 0,
        'Adolescentes' => 0,
        'Jovens' => 0,
        'Adultos' => 0,
    ];
    $hoje = now();

    membros::query()->get(['data_nascimento'])->each(function ($membro) use (&$ageData, $hoje) {
        $dataNascimento = Carbon::parse($membro->data_nascimento);

        if ($dataNascimento->isFuture()) {
            return;
        }

        $idade = $dataNascimento->diffInYears($hoje);
        $faixa = match (true) {
            $idade <= 11 => 'Crianças',
            $idade <= 17 => 'Adolescentes',
            $idade <= 35 => 'Jovens',
            default => 'Adultos',
        };

        $ageData[$faixa]++;
    });

    $ageLabels = array_keys($ageData);
    $ageData = array_values($ageData);

    return view('dashboard', compact(
        'membros_c',
        'membros_a',
        'f',
        'm',
        'growthLabels',
        'growthData',
        'ageLabels',
        'ageData'
    ));
    }


    public function welcome(){

            $eventos=eventos::get();
            // $data->format('l'); formatra data para exibir o dia da semana.
      return view('welcome', compact('eventos'));
    }
}
