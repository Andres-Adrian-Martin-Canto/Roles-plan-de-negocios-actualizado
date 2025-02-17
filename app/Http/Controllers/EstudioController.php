<?php

namespace App\Http\Controllers;

use App\Models\Estudio;
use App\Models\Plan_de_negocio;
use Illuminate\Http\Request;
use PDF;

class EstudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        return view('estudio.index', compact('plan_de_negocio'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Plan_de_negocio $plan_de_negocio)
    {
        return view('estudio.create', compact('plan_de_negocio'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Plan_de_negocio $plan_de_negocio)
    {
        $validated = $request->validate([
            'nombre' => 'required',
            'objetivo' => 'required',
            'objetivos_especificos' => 'required',
            'especificacion' => 'required',
        ]);

        $estudio = $plan_de_negocio->estudios()->create($validated);

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }

        return redirect()->route($user_route.'plan_de_negocio.estudio.index', compact('plan_de_negocio'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan_de_negocio $plan_de_negocio, Estudio $estudio)
    {
        return view('estudio.show', compact('plan_de_negocio', 'estudio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estudio $estudio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan_de_negocio $plan_de_negocio, Estudio $estudio)
    {
        $validated = $request->validate([
            'nombre' => 'required',
            'objetivo' => 'required',
            'objetivos_especificos' => 'required',
            'especificacion' => 'required',
        ]);

        $estudio->update($validated);

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }
        return redirect()->route($user_route.'plan_de_negocio.estudio.index', compact('plan_de_negocio', 'estudio'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan_de_negocio $plan_de_negocio, Estudio $estudio)
    {
        Estudio::destroy($estudio->id);
        return back(); 
    }

    public function pdf(Plan_de_negocio $plan_de_negocio, Estudio $estudio)
    {
        $pdf = PDF::loadview('estudio.pdf', ['plan_de_negocio' => $plan_de_negocio, 'estudio' => $estudio]);
        return $pdf->stream();
    }
}
