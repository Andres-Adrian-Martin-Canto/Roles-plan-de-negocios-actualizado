<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use App\Models\CostoFijo;
use Illuminate\Http\Request;
use App\Models\CostosVariable;
use App\Models\Plan_de_negocio;
use App\Models\EstudioFinanciero;
use App\Models\costosFijosCincoAnios;
use App\Models\costosVariablesCincoAniosConservador;
use App\Models\ingresosCincoAniosConservador;

class cincoAniosConservador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        // Buscamos a cual estudio pertenece
        $estudio = EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)->first();
        // Arreglos que me van a servir para crear la estructura de datos cuando no exista datos de cinco años.
        // * Arrays para fijos
        $arrayCincoFijos = [];
        $arrayAnualFijos = [];
        // * Arrays para variables
        $arrayAnualVariables = [];
        $arrayCincoVariables = [];
        // * Arrays para ingresos
        $arrayAnualIngresos = [];
        $arrayCincoIngresos = [];
        $montoTotal = 0;
        // * Variable que dice si el boton estara prendido o no.
        $estaActivado = false;
        // * Variables para enviar el titulo y la ruta dinámicamente
        $titulo = "Proyección cinco años Conservador";
        $url = route('plan_de_negocio.proyeccionConservadorCincoAnios.store', $plan_de_negocio);

        // * Si no existen datos anuales fijos, variables o ingresos va a pedir que regrese al anual correspondiente para guardar.
        if ((count($estudio->ingresos_anuales) < 1) || (count($estudio->costos_variables_anuales) < 1) || (count($estudio->costos_fijos_anuales)) < 1) {
            return back()->with('mensaje', 'Ingrese primero los anuales conservadores');
        }


        // TODO: Condición para capturan los datos correspondientes.
        // * Si existen los costos fijos de cinco años los capturan
        if (count($estudio->fijos_cincoAnios) > 0) {
            // TODO: Estructurando los datos fijos.
            $fijosOrdenados = $estudio->fijos_cincoAnios()->orderBy('Id_costo_fijo')->orderBy('anio')->get();
            foreach ($fijosOrdenados as $value) {
                $fijo = CostoFijo::find($value->Id_costo_fijo);
                $arrayCincoFijos[$value->Id_costo_fijo][$fijo->nombre][$value->anio] = [$value->id, $value->monto_conservador];
            }
            // * Si existe los costos fijos anuales capturara los datos.
        } else {
            $estaActivado = true;
            // TODO: Pedir los datos ordenados.
            // * Obtengo los costos Fijos.
            $costosFijosAnuales = $estudio->costos_fijos_anuales()
                ->orderBy('Id_costo_fijo')
                ->orderBy('mes')
                ->get();
            // TODO: Calcular el total de costo fijo anual
            foreach ($costosFijosAnuales as  $value) {
                // Suma todos los valores
                $montoTotal += $value->monto_conservador;
                // Cuando llegue a 12 lo almacenara
                if ($value->mes == 12) {
                    // Busco el costo fijo.
                    $cFijo = CostoFijo::find($value->Id_costo_fijo);
                    // Lo agrego al arreglo.
                    $arrayAnualFijos[$value->Id_costo_fijo][$cFijo->nombre] = $montoTotal;
                    // Regreso el valor por a cero para que no se acumulen
                    $montoTotal = 0;
                }
            }
        }


        // TODO: Condición para capturan los datos correspondientes.
        if (count($estudio->variables_conservador_cincoAnios) > 0) {
            // TODO: Estructurando los datos variables
            $variablesOrdenados = $estudio->variables_conservador_cincoAnios()->orderBy('Id_costo_variable')->orderBy('anio')->get();
            foreach ($variablesOrdenados as  $value) {
                $variable = CostosVariable::find($value->Id_costo_variable);
                $arrayCincoVariables[$value->Id_costo_variable][$variable->nombre][$value->anio] = [$value->id, $value->monto_conservador];
            }
            // * Si no existen costos variables de cinco años agarra los anuales
        } else {
            $estaActivado = true;
            $costosVariablesAnuales = $estudio->costos_variables_anuales()
                ->orderBy('Id_costo_variable')
                ->orderBy('mes')
                ->get();
            // TODO: Calcular el total de costo variable anual
            foreach ($costosVariablesAnuales as $value) {
                $montoTotal += $value->monto_conservador;
                // Cuando llegue a 12 lo almacenara
                if ($value->mes == 12) {
                    // Busco el costo variable
                    $cVariable = CostosVariable::find($value->Id_costo_variable);
                    // Lo agrego al arreglo.
                    $arrayAnualVariables[$value->Id_costo_variable][$cVariable->nombre] = $montoTotal;
                    // Regreso el valor por a cero para que no se acumulen
                    $montoTotal = 0;
                }
            }
        }


        // TODO: Condición para capturar los datos correctos de ingresos
        if (count($estudio->ingresos_conservador_CincoAnios) > 0) {
            // TODO: Estructurando los datos ingresos
            $ingresosOrdenados = $estudio->ingresos_conservador_CincoAnios()->orderBy('Id_ingresos')->orderBy('anio')->get();
            foreach ($ingresosOrdenados as  $value) {
                $ingreso = Ingreso::find($value->Id_ingresos);
                $arrayCincoIngresos[$value->Id_ingresos][$ingreso->nombre][$value->anio] = [$value->id, $value->monto_conservador];
            }
            // * Si no existen ingresos de cinco años agarra los anuales
        } else {
            $estaActivado = true;
            // * Obtengo los Ingresos conservador
            $ingresosAnuales = $estudio->ingresos_anuales()
                ->orderBy('Id_ingresos')
                ->orderBy('mes')
                ->get();
            // TODO: Calcular el total de ingresos.
            foreach ($ingresosAnuales as  $value) {
                $montoTotal += $value->monto_conservador;
                if ($value->mes == 12) {
                    // Busco el ingreso correcto
                    $ingreso = Ingreso::find($value->Id_ingresos);
                    // Lo agrego al arreglo.
                    $arrayAnualIngresos[$value->Id_ingresos][$ingreso->nombre] = $montoTotal;
                    // Regreso el valor por a cero para que no se acumulen
                    $montoTotal = 0;
                }
            }
        }

        // * Envió de datos a la vista.
        return view('plan_financiero.proyeccionCincoAnios', [
            'arrayAnualFijo' => $arrayAnualFijos,
            'arrayAnualVariable' => $arrayAnualVariables,
            'arrayAnualIngresos' => $arrayAnualIngresos,
            'costosCincoAniosFijos' => $arrayCincoFijos,
            'costosCincoAniosVariables' => $arrayCincoVariables,
            'ingresosCincoAnios' => $arrayCincoIngresos,
            'plan_de_negocio' => $plan_de_negocio,
            'ruta' => $url,
            'titulo' => $titulo,
            // TODO: Envio pasa saber si el boton se vera activado.
            'estaActivado' => $estaActivado
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
        $estructuraConvertida = json_decode($request->getContent(), true);
        $costosFijos = $estructuraConvertida[0];
        $costosVariables = $estructuraConvertida[1];
        $ingresos = $estructuraConvertida[2];

        // TODO: Almacenando o actualizando los costos fijos
        foreach ($costosFijos as $key => $value) {
            for ($i = 0; $i < count($value); $i++) {
                costosFijosCincoAnios::updateOrCreate(
                    ['id' => $value[$i][0]],
                    [
                        'Id_estudio_financiero' => $estudio->id,
                        'Id_costo_fijo' => $key,
                        'anio' => $i + 1,
                        'monto_conservador' => $value[$i][1]
                    ]
                );
            }
        }

        // TODO: Almacenamos o actualizamos los costos variables conservador
        foreach ($costosVariables as $key => $value) {
            for ($i = 0; $i < count($value); $i++) {
                costosVariablesCincoAniosConservador::updateOrCreate(
                    ['id' => $value[$i][0]],
                    [
                        'Id_estudio_financiero' => $estudio->id,
                        'Id_costo_variable' => $key,
                        'anio' => $i + 1,
                        'monto_conservador' => $value[$i][1]
                    ]
                );
            }
        }

        // TODO: Almacenamos o actualizamos los ingresos
        foreach ($ingresos as $key => $value) {
            for ($i = 0; $i < count($value); $i++) {
                ingresosCincoAniosConservador::updateOrCreate(
                    ['id' => $value[$i][0]],
                    [
                        'Id_estudio_financiero' => $estudio->id,
                        'Id_ingresos' => $key,
                        'anio' => $i + 1,
                        'monto_conservador' => $value[$i][1]
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
