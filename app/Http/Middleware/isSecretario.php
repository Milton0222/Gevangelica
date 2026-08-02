<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isSecretario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       if(Auth::user()->isSecretario) 
           return $next($request);
        else{
            alert(Auth::user()->name,'Acesso Negado!'.'/Consultar Área técnica','error');

            return redirect()->route('dashboard');
        }
    }
}
