<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan_de_negocio;

class plan_financiero_mensual extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        // Le envio la vista el id que se esta usando.
        $variable =  $plan_de_negocio->id;

        return view('plan_financiero.index', compact('variable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Acceder al JSON enviado desde JavaScript
        $jsonData = $request->json()->all();
        $primerValor = $jsonData[0][2];
        // Hacer algo con el valor obtenido
        return response()->json($primerValor);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
