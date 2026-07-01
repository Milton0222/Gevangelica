<?php

namespace App\Http\Controllers;

use App\Models\membros;
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

       return view('dashboard', compact('membros_c','membros_a','f','m'));
    }
}
