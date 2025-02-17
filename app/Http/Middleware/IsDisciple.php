<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsDisciple
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->rol != "discipulo")
        {
            if(Auth::user()->rol == "asesor"){
                return redirect('/asesor.dashboard');
            }
            else if(Auth::user()->rol == "admin"){
                return redirect('/admin.dashboard');    
            }
        }
        return $next($request);
    }
}
