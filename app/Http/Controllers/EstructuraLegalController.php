<?php

namespace App\Http\Controllers;

use App\Models\Estructura_legal;
use App\Models\Plan_de_negocio;
use Illuminate\Http\Request;

class EstructuraLegalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        return view('estructura_legal.index', compact('plan_de_negocio'));
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
        $validated = $request->validate([
            'tipo_persona' => 'required',
            'constitucion_legal' => 'required',
            'regimen_fiscal' => 'required',
        ]);

        $estructura_legal = $plan_de_negocio->estructura_legal()->create($validated);

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }
        return redirect()->route($user_route.'plan_de_negocio.estructura_legal.index', compact('plan_de_negocio'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Estructura_legal $estructura_legal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan_de_negocio $plan_de_negocio, Estructura_legal $estructura_legal)
    {
        return view('estructura_legal.edit', compact('plan_de_negocio', 'estructura_legal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan_de_negocio $plan_de_negocio, Estructura_legal $estructura_legal)
    {
        $validated = $request->validate([
            'tipo_persona' => 'required',
            'constitucion_legal' => 'required',
            'regimen_fiscal' => 'required',
        ]);

        $estructura_legal->update($validated);
        return view('estructura_legal.index', compact('plan_de_negocio'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan_de_negocio $plan_de_negocio, Estructura_legal $estructura_legal)
    {
        Estructura_legal::destroy($estructura_legal->id);
        
        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }
        return redirect()->route($user_route.'plan_de_negocio.estructura_legal.index', compact('plan_de_negocio'));
    }
}
