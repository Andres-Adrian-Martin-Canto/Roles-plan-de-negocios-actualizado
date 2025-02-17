<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\CostoFijo;
use Illuminate\Http\Request;
use App\Models\Plan_de_negocio;
use App\Models\EstudioFinanciero;
use Illuminate\Support\Facades\Log;

class CostoFijoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        $estudio = EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)->first();
        if ($estudio) {
            return view('plan_financiero.costoFijo', [
                'plan_de_negocio' => $plan_de_negocio,
                'costos_fijos' => $estudio->costosFijos,
                'datosAnuales' => count($estudio->costos_fijos_anuales) > 0
            ]);
        } else {
            // No se encontró el estudio financiero, puedes manejar esta situación según tu lógica
            return view('plan_financiero.costoFijo', [
                'plan_de_negocio' => $plan_de_negocio,
                'costos_fijos' => [], // o cualquier otro valor predeterminado
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
        // * variable que me ayudara a calcular
        $totalCostoFijo = 0;
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
            // TODO: Si no esta vacio entonces va a insertar
            if ($jsonData[0][0] !== null && $jsonData[0][1] !== null && $jsonData[0][2] !== null) {
                // * Se almacena en la base de datos.
                foreach ($jsonData as $fila) {
                    CostoFijo::create([
                        'estudio_financiero_id' => $nuevoEstudio->id,
                        'nombre' => $fila[0],
                        'valor_unitario' => $fila[1],
                        'monto_unitario' => $fila[2],
                    ]);
                    $totalCostoFijo += $fila[3];
                }
                // * Luego modificar el total_costo_fijo.
                EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)
                    ->update(['total_costo_fijo' => $totalCostoFijo]);
            }
        } else {
            // TODO: Si el json esta vacio entonces es eliminar
            if ($jsonData[0][0] === null && $jsonData[0][1] === null && $jsonData[0][2] === null) {
                // TODO: Si es que tiene datos costo fijo se mandan a eliminar
                $estudioFinanciero->costosFijos()->delete();
                // * Se manda actualizar el total de costo fijo
                EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)
                    ->update(['total_costo_fijo' => 0]);
            } else {
                // TODO: Si existe un costo fijo entonces lo elimina y crea los nuevos datos.
                if (count($estudioFinanciero->costosFijos) > 0) {
                    $estudioFinanciero->costosFijos()->delete();
                    // * Se almacena en la base de datos.
                    foreach ($jsonData as $fila) {
                        CostoFijo::create([
                            'estudio_financiero_id' => $estudioFinanciero->id,
                            'nombre' => $fila[0],
                            'valor_unitario' => $fila[1],
                            'monto_unitario' => $fila[2],
                        ]);
                        $totalCostoFijo += $fila[3];
                    }
                    // * Luego modificar el total_costo_fijo.
                    EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)
                        ->update(['total_costo_fijo' => $totalCostoFijo]);
                    // TODO: Si no hay entonces se crea.
                } else {
                    // * Se almacena en la base de datos.
                    foreach ($jsonData as $fila) {
                        CostoFijo::create([
                            'estudio_financiero_id' => $estudioFinanciero->id,
                            'nombre' => $fila[0],
                            'valor_unitario' => $fila[1],
                            'monto_unitario' => $fila[2],
                        ]);
                        $totalCostoFijo += $fila[3];
                    }
                    // * Luego modificar el total_costo_fijo.
                    EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)
                        ->update(['total_costo_fijo' => $totalCostoFijo]);
                }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CostoFijo $costoFijo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CostoFijo $costoFijo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CostoFijo $costoFijo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CostoFijo $costoFijo)
    {
        //
    }
}
