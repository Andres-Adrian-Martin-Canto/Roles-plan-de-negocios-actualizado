<?php

namespace App\Http\Controllers;

use App\Models\Plan_de_negocio;
use App\Models\Estudio;
use App\Models\Concepto;
use Illuminate\Http\Request;

class CapturarResultadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio, Estudio $estudio)
    {
        return view('capturar_resultados.index',['plan_de_negocio' => $plan_de_negocio, 'estudio' => $estudio]);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan_de_negocio $plan_de_negocio, Estudio $estudio, Concepto $capturar_resultado)
    {
        $data = $request->validate([
            'conclusion' => 'required',
        ]);

        $capturar_resultado->update($data);

        return view('capturar_resultados.index',['plan_de_negocio'=>$plan_de_negocio, 'estudio'=>$estudio]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
