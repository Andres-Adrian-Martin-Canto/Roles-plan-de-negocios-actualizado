<?php

namespace App\Http\Controllers;

use App\Models\Plan_de_negocio;
use Illuminate\Http\Request;

class ProyeccionCincoAniosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        $proyeccionmensual = $plan_de_negocio->proyecciondesueldomensual;
        $arraydatoscincoanios = [];
        // Construir $arraydatoscincoanios
        foreach ($proyeccionmensual as $value) {
            $sueldoscincoanios = $value->proyeccionCincoAnios()->orderBy('proyección_de_sueldos')->orderBy('anio')->get();
            // dd($sueldoscincoanios);
            // Si existen sueldos anuales
            if ($sueldoscincoanios->isNotEmpty()) {
                foreach ($sueldoscincoanios as $cincoanios) {
                    $arraydatoscincoanios[$value->id][$value->pertenecedescripcionpuesto->nombre_puesto][$cincoanios->anio] = [
                        'id_anual' => $cincoanios->id,
                        'monto' => $cincoanios->sueldo_total_anual
                    ];
                }
            } else {
                $sueldosanules = $value->proyecciondesueldoanual()->orderBy('proyección_de_sueldos')->orderBy('mes')->get();
                $montoTotal = 0;
                $contador = 1;
                foreach ($sueldosanules as $datoanual) {
                    $montoTotal += $datoanual->sueldo_total_por_mes;

                    if ($datoanual->mes == 12) {
                        $arraydatoscincoanios[$value->id][$value->pertenecedescripcionpuesto->nombre_puesto][$contador] = [
                            'id_anual' => 0,
                            'monto' => $montoTotal
                        ];
                        $contador++;
                        $montoTotal = 0;
                    }
                }
            }
        }
        $ruta = route('plan_de_negocio.proyeccionsueldocincoanios.store', $plan_de_negocio);
        // dd(count(end($arraydatoscincoanios)));
        return view('proyecciones.cinco_anios', compact('plan_de_negocio', 'arraydatoscincoanios', 'ruta'));
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
