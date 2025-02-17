<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan_de_negocio;
use App\Models\DescripcionPuesto;
use Illuminate\Support\Facades\Log;

class ControladorOperativo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        // Obtener solo las descripciones de nivel 'Operativo' asociadas al plan de negocio
        $descripcionesEstrategicos = $plan_de_negocio->descripcionpuesto()
        ->where('nivel', 'tactico')->select('id','unidad_administrativa')
        ->get();
        // dd( $descripcionesEstrategicos);
        return view('descripciones.operativo', ['descripcionesEstrategicos'=>$descripcionesEstrategicos, 'plan_de_negocio'=>$plan_de_negocio]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan_de_negocio $plan_de_negocio, $id)
    {
        $descripcion = DescripcionPuesto::findOrFail($id);
        $tacticos = $plan_de_negocio->descripcionpuesto()->where('nivel', 'tactico')->get();
        return view('descripciones.operativo', compact('descripcion', 'tacticos', 'plan_de_negocio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan_de_negocio $plan_de_negocio, $id)
    {
        $descripcionPuesto = DescripcionPuesto::findOrFail($id);
        Log::info($descripcionPuesto);
        // Actualiza los datos del registro
        $descripcionPuesto->update($request->all());
        return redirect()->route('plan_de_negocio.descripciones.index', ['plan_de_negocio' => $plan_de_negocio]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
