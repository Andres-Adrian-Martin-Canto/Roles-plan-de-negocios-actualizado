<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstudioFinanciero;
use App\Models\Plan_de_negocio;

class estadisticasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        $estudio = EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)->first();
        // Si existe el estudio envia los datos correctos.
        if ($estudio) {
            if ($estudio->ingresos->count() > 0 && $estudio->costosFijos->count() > 0 && $estudio->costosVariables->count()) {

                return view('plan_financiero.indexProyeccion', [
                    'plan_de_negocio' => $plan_de_negocio,
                    'costos_fijos' => $estudio->total_costo_fijo,
                    'costos_variable' => $estudio->total_costo_variable,
                    'ingresos' => $estudio->total_ingresos
                ]);
            }else{
                return redirect()->back()->with('mensaje', 'No se pueden ingresar años hasta que ingreses los costos fijos, variables e ingresos.');
            }
            // De lo contrario envia datos por default.
        } else {
            return redirect()->back()->with('mensaje', 'No se pueden ingresar años hasta que ingreses los costos fijos, variables e ingresos.');
        }
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
