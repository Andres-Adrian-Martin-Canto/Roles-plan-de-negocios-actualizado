<?php

namespace App\Http\Controllers;

use App\Models\Publicidad;
use App\Models\Plan_de_negocio;
use Illuminate\Http\Request;

class PublicidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        return view('publicidad.index', compact('plan_de_negocio'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Plan_de_negocio $plan_de_negocio)
    {
        //dd($request);
    
        $validated = $request->validate([
            'plan_promocion' => 'required',
            'comercializacion' => 'required',
            'plan_mercadotecnia' => 'required',
        ]);

        $publicidad = $plan_de_negocio->publicidades()->create($validated);

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }

        return redirect()->route($user_route.'plan_de_negocio.publicidad.index', compact('plan_de_negocio'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Publicidad $publicidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan_de_negocio $plan_de_negocio, Publicidad $publicidad)
    {
        return view('publicidad.edit', compact('plan_de_negocio', 'publicidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan_de_negocio $plan_de_negocio, Publicidad $publicidad)
    {
        $validated = $request->validate([
            'plan_promocion' => 'required',
            'comercializacion' => 'required',
            'plan_mercadotecnia' => 'required',
        ]);

        $publicidad->update($validated);

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }

        return redirect()->route($user_route.'plan_de_negocio.publicidad.index', compact('plan_de_negocio'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan_de_negocio $plan_de_negocio, Publicidad $publicidad)
    {
        Publicidad::destroy($publicidad->id);
        return back();
    }
}
