<?php

namespace App\Http\Controllers;

use App\Models\Concepto;
use App\Models\Plan_de_negocio;
use App\Models\Estudio;
use Illuminate\Http\Request;

class ConceptoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio, Estudio $estudio)
    {
        return view('concepto.index', compact('plan_de_negocio', 'estudio'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Plan_de_negocio $plan_de_negocio, Estudio $estudio)
    {
        return view('concepto.create', compact('plan_de_negocio', 'estudio'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Plan_de_negocio $plan_de_negocio, Estudio $estudio)
    {
        $validated = $request->validate([
            'concepto' => 'required',
        ]);

        $estudio->conceptos()->create($validated);

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }

        return redirect()->route($user_route.'plan_de_negocio.estudio.concepto.index', ['plan_de_negocio' => $plan_de_negocio, 'estudio' => $estudio]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Concepto $concepto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Concepto $concepto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan_de_negocio $plan_de_negocio, Estudio $estudio, Concepto $concepto)
    {
        $validated = $request->validate([
            'concepto' => 'required',
        ]);

        $concepto->update($validated);

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }

        return redirect()->route($user_route.'plan_de_negocio.estudio.concepto.index', ['plan_de_negocio' => $plan_de_negocio, 'estudio' => $estudio]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan_de_negocio $plan_de_negocio, Estudio $estudio, Concepto $concepto)
    {
        Concepto::destroy($concepto->id);
        return back();
    }
}
