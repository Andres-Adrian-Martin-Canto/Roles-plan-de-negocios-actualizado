<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan_de_negocio;
use App\Models\ProyeccionCincoAnios;

class ProyeccionCincoAniosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        $proyeccionmensual = $plan_de_negocio->proyecciondesueldomensual; 
        if ($proyeccionmensual->first()->proyecciondesueldoanual->isEmpty()) {
            return redirect()->back()->with('mensaje', 'No se pueden ingresar hasta guardar los de un año.');
        }
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
    public function store(Request $request, Plan_de_negocio $plan_de_negocio)
    {
        foreach ($request->all() as $key => $value) {
            // Log::info($value);
            for ($i = 0; $i < count($value); $i++) {

                //     // for ($i = 0; $i < $value; $i++) {
                ProyeccionCincoAnios::updateOrCreate(
                    ['id' => $value[$i][0]],
                    [
                        'proyección_de_sueldos' => $key,
                        'anio' => $i + 1,
                        'sueldo_total_anual' => $value[$i][1]
                    ]
                );
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
