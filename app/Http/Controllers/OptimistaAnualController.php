<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan_de_negocio;
use App\Models\EstudioFinanciero;
use App\Models\CostosFijosAnuales;
use App\Models\IngresosAnualesOptimista;
use App\Models\CostosVariablesAnualesOptimista;

class OptimistaAnualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        // Obtengo el estudio Financiero.
        $estudio = EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)->first();
        // TODO: Obtengo los costos Fijos.
        $costosFijosAnuales = $estudio->costos_fijos_anuales()
            ->orderBy('Id_costo_fijo')
            ->orderBy('mes')
            ->get();
        $costosVariablesAnuales = $estudio->variables_optimista()
            ->orderBy('Id_costo_variable')
            ->orderBy('mes')
            ->get();
        $ingresosAnuales = $estudio->ingresos_optimista()
            ->orderBy('Id_ingresos')
            ->orderBy('mes')
            ->get();
        // TODO: Agrupo los costos fijos
        $costosFijosAgrupados = [];
        foreach ($costosFijosAnuales as $costoFijo) {
            $nombreCostoFijo = $costoFijo->costo_fijo->nombre;
            $id = $costoFijo->costo_fijo->id;
            $mes = $costoFijo->mes;
            $montoConservador = $costoFijo->monto_conservador;
            $costosFijosAgrupados[$id][$nombreCostoFijo][$mes] = $montoConservador;
        }
        // TODO: Agrupo los costos variables
        $costosVariablesAgrupados = [];
        foreach ($costosVariablesAnuales as $costoVariable) {
            $nombreCostoVariable = $costoVariable->costo_variable->nombre;
            $id = $costoVariable->costo_variable->id;
            $mes = $costoVariable->mes;
            $monto_optimista = $costoVariable->monto_optimista;
            $costosVariablesAgrupados[$id][$nombreCostoVariable][$mes] = $monto_optimista;
        }
        // TODO: Agrupo los ingresos
        $IngresosAgrupados = [];
        foreach ($ingresosAnuales as $ingreso) {
            $nombreIngreso = $ingreso->ingreso->nombre;
            $id = $ingreso->ingreso->id;
            $mes = $ingreso->mes;
            $monto_optimista = $ingreso->monto_optimista;
            $IngresosAgrupados[$id][$nombreIngreso][$mes] = $monto_optimista;
        }
        // TODO: Lo envio en la vista.
        return view('plan_financiero.optimistaAnual', [
            'plan_de_negocio' => $plan_de_negocio,
            'costos_fijos' => $estudio->costosFijos,
            'costosFijosAgrupados' => $costosFijosAgrupados,
            'costos_variables' => $estudio->costosVariables,
            'costosVariablesAgrupados' => $costosVariablesAgrupados,
            'ingresos' => $estudio->ingresos,
            'ingresos_anual' => $IngresosAgrupados
        ]);
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
        // Busco el estudio.
        $estudio = EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)->first();
        if (count($estudio->costos_fijos_anuales) > 0 && count($estudio->variables_optimista) > 0
        && count($estudio->ingresos_optimista) > 0) {
            // * Borrar los que ya estan.
            // Borrar los costos fijos
            CostosFijosAnuales::where('Id_estudio_financiero', $estudio->id)->delete();
            $estudio->variables_optimista()->delete();
            $estudio->ingresos_optimista()->delete();
        }
        // Crea los nuevos datos.
        // Obtiene todos los costos fijos.
        $costos_fijos_anuales = $request->input('costos_Fijos');
        // Obtener todos los costos variables
        $costos_Variables_anuales = $request->input('costos_variables');
        // Obtener todos los Ingresos.
        $ingresos_anuales = $request->input('ingresos');
        // TODO: Inserta datos Costos Fijos
        foreach ($costos_fijos_anuales as $fila) {
            for ($j = 0; $j < count($fila) - 1; $j++) {
                CostosFijosAnuales::create([
                    'Id_estudio_financiero' => $estudio->id,
                    'Id_costo_fijo' => $fila[0],
                    'mes' => ($j + 1),
                    'monto_conservador' => $fila[$j + 1]
                ]);
            }
        }
        // TODO: Insertamos datos Costos Variables Optimista
        foreach ($costos_Variables_anuales as $fila) {
            for ($i = 0; $i < count($fila) - 1; $i++) {
                CostosVariablesAnualesOptimista::create([
                    'Id_estudio_financiero' => $estudio->id,
                    'Id_costo_variable' => $fila[0],
                    'mes' => ($i + 1),
                    'monto_optimista' => $fila[$i + 1]
                ]);
            }
        }
        // TODO: Insertamos datos Ingresos Optimista
        foreach ($ingresos_anuales as $fila) {
            for ($i = 0; $i < count($fila) - 1; $i++) {
                IngresosAnualesOptimista::create([
                    'Id_estudio_financiero' => $estudio->id,
                    'Id_ingresos' => $fila[0],
                    'mes' => ($i + 1),
                    'monto_optimista' => $fila[$i + 1]
                ]);
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
