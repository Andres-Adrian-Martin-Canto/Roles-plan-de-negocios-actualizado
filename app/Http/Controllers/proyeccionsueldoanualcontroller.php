<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan_de_negocio;
use Illuminate\Support\Facades\Log;
use App\Models\proyecciondesueldoanual;

class proyeccionsueldoanualcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        $proyeccionmensual = $plan_de_negocio->proyecciondesueldomensual;
        $arraydatosanuales = [];
        // $totalmensual = 0;

        // // Calcular el total mensual
        // foreach ($proyeccionmensual as $value) {
        //     $totalmensual += $value->total;
        // }

        // Construir $arraydatosanuales
        foreach ($proyeccionmensual as $value) {
            $sueldosanules = $value->proyecciondesueldoanual()->orderBy('id')->orderBy('mes')->get();
            // Si existen sueldos anuales
            if ($sueldosanules->isNotEmpty()) {
                foreach ($sueldosanules as $anual) {
                    $arraydatosanuales[$value->id][$value->pertenecedescripcionpuesto->nombre_puesto][$anual->mes] = [
                        'id_anual' => $anual->id,
                        'monto' => $anual->sueldo_total_por_mes,
                    ];
                }
            } else {
                // Si no existen sueldos anuales, crear valores predeterminados para los 12 meses
                for ($i = 1; $i < 13; $i++) {
                    $arraydatosanuales[$value->id][$value->pertenecedescripcionpuesto->nombre_puesto][$i] = [
                        'id_anual' => 0,
                        'monto' => $value->total,
                    ];
                }
            }
        }
        $ruta = route('plan_de_negocio.proyeccionsueldoanual.store', $plan_de_negocio);
        return view('proyecciones.anual', compact('plan_de_negocio', 'arraydatosanuales', 'ruta'));
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
    public function store(Plan_de_negocio $plan_de_negocio, Request $request)
    {
        foreach ($request->all() as $key => $value) {
            // Log::info($value);
            for ($i = 0; $i < count($value); $i++) {
              
            //     // for ($i = 0; $i < $value; $i++) {
                    proyecciondesueldoanual::updateOrCreate(
                        ['id' => $value[$i][0]],
                        [
                            'proyección_de_sueldos' => $key,
                            'mes' => $i +1,
                            'sueldo_total_por_mes' => $value[$i][1]
                        ]
                    );
            //     // }
            }
        }
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
