<?php

namespace App\Http\Controllers;

use App\Models\CostosVariable;
use App\Models\EstudioFinanciero;
use App\Models\Plan_de_negocio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CostosVariableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        //
        $estudio = EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)->first();
        // Verificar si se encontró el estudio financiero
        if ($estudio) {
            return view('plan_financiero.costoVariable', [
                'plan_de_negocio' => $plan_de_negocio,
                'costos_variable' => $estudio->costosVariables,
                'datosAnuales' => (count($estudio->costos_variables_anuales) > 0 || count($estudio->variables_pesimistas) > 0 || count($estudio->variables_optimista) > 0)
            ]);
        } else {
            // No se encontró el estudio financiero y se envia un valor por defecto
            return view('plan_financiero.costoVariable', [
                'plan_de_negocio' => $plan_de_negocio,
                'costos_variable' => [],
                'datosAnuales' => false
            ]);
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
    public function store(Request $request, Plan_de_negocio $plan_de_negocio)
    {

        // * Obtengo todo en formato json.
        $jsonData = $request->json()->all();
        // * Variable para calcular el total.
        $totalCostoVariable = 0;
        // * Hay que buscar si existe en la tabla estudio financiero si no pues se crea.
        $estudioFinanciero = EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)->first();
        // * Si no existe se crea en la tabla estudio financiero.
        if (!$estudioFinanciero) {
            // * Crear uno nuevo
            $nuevoEstudio = EstudioFinanciero::create([
                'plan_de_negocio_id' => $plan_de_negocio->id,
                'total_costo_fijo' => 0.0,
                'total_costo_variable' => 0.0,
                'total_ingresos' => 0.0,
            ]);
            // * Se almacena en la base de datos.
            foreach ($jsonData as $fila) {
                CostosVariable::create([
                    'estudio_financiero_id' => $nuevoEstudio->id,
                    'nombre' => $fila[0],
                    'valor_unitario' => $fila[1],
                    'monto_unitario' => $fila[2],
                    'escenario_conservador' => $fila[3],
                    'escenario_optimista' => $fila[4],
                    'escenario_pesimista' => $fila[5]
                ]);
                $totalCostoVariable += $fila[3];
            }
            // * Luego modificar el total_costo_fijo.
            EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)
                ->update(['total_costo_variable' => $totalCostoVariable]);
            //TODO:  Si existe el costo fijo entrara aqui.
        } else {
            // * Si esta vacio el json entonces entra aqui.
            if ($jsonData[0][0] === null && $jsonData[0][1] === null && $jsonData[0][2] === null && $jsonData[0][4] === null && $jsonData[0][5] === null) {
                // * Mando a eliminar los que existen.
                $estudioFinanciero->costosVariables()->delete();
                // * Actualizo la columna correspondiente.
                EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)
                    ->update(['total_costo_variable' => 0]);
                // * De lo contrario si no esta vacio entonces hara lo siguiente.
            } else {
                // * Mando a eliminar los que existen.
                $estudioFinanciero->costosVariables()->delete();
                // * Mando a guardar los datos.
                foreach ($jsonData as $fila) {
                    CostosVariable::create([
                        'estudio_financiero_id' => $estudioFinanciero->id,
                        'nombre' => $fila[0],
                        'valor_unitario' => $fila[1],
                        'monto_unitario' => $fila[2],
                        'escenario_conservador' => $fila[3],
                        'escenario_optimista' => $fila[4],
                        'escenario_pesimista' => $fila[5]
                    ]);
                    $totalCostoVariable += $fila[3];
                }
                // * Actualizo en campo correspondiente.
                EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)
                    ->update(['total_costo_variable' => $totalCostoVariable]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CostosVariable $costosVariable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CostosVariable $costosVariable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CostosVariable $costosVariable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CostosVariable $costosVariable)
    {
        //
    }
}
