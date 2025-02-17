<?php

namespace App\Http\Controllers;

use App\Models\CostoFijo;
use Illuminate\Http\Request;
use App\Models\Plan_de_negocio;
use App\Models\EstudioFinanciero;
use App\Models\CostosFijosAnuales;
use App\Models\CostosVariable;
use App\Models\IngresosAnualesConservador;
use App\Models\CostosVariablesAnualesConservador;
use App\Models\Ingreso;

class ConservadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        // TODO: Variables que me ayudaran a capturar los datos
        // * Arrays de fijos
        $arrayAnualesFijos = [];
        $arrayMensualesFijos = [];
        // * Arrays de variables
        $arrayAnualesVariables = [];
        $arrayMensualesVariables = [];
        // * Arrays de ingresos
        $arrayAnualesIngresos = [];
        $arrayMensualesIngresos = [];
        $estaActivado = false;
        // * Variable que me va a servir para enviar dinamicamente el titulo
        $titulo = "Proyección anual Conservador";

        // * Obtener el estudio al cual pertenece.
        $estudio = EstudioFinanciero::where('plan_de_negocio_id', $plan_de_negocio->id)->first();

        // TODO: Captura de costos fijos Anuales
        if (count($estudio->costos_fijos_anuales) > 0) {
            // TODO: Obtengo todos los costosFijosAnuales que pertenecen al estudio financiero correspondiente.
            $costosFijosAnuales = $estudio->costos_fijos_anuales()
                ->orderBy('Id_costo_fijo')
                ->orderBy('mes')
                ->get();
            // * Ordenando los datos.
            foreach ($costosFijosAnuales as $value) {
                $fijo = CostoFijo::find($value->Id_costo_fijo);
                $arrayAnualesFijos[$value->Id_costo_fijo][$fijo->nombre][$value->mes] = [$value->id, $value->monto_conservador];
            }
            // * De lo contrario agarra los mensuales
        } else {
            $estaActivado = true;
            $fijosMensuales = $estudio->costosFijos;
            foreach ($fijosMensuales as $value) {
                $arrayMensualesFijos[$value->id][$value->nombre] = $value->valor_unitario * $value->monto_unitario;
            }
        }


        // TODO: Captura los costos Variables Anuales
        if (count($estudio->costos_variables_anuales) > 0) {
            // * Obtengo los costos variables anuales.
            $costosVariablesAnuales = $estudio->costos_variables_anuales()
                ->orderBy('Id_costo_variable')
                ->orderBy('mes')
                ->get();
            // * Ordenando los datos.
            foreach ($costosVariablesAnuales as $value) {
                $Variables = CostosVariable::find($value->Id_costo_variable);
                $arrayAnualesVariables[$value->Id_costo_variable][$Variables->nombre][$value->mes] = [$value->id, $value->monto_conservador];
            }
            // * De lo contrario agarra los mensuales
        } else {
            $estaActivado = true;
            $variablesMensuales = $estudio->costosVariables;
            foreach ($variablesMensuales as $value) {
                $arrayMensualesVariables[$value->id][$value->nombre] = $value->escenario_conservador;
            }
        }


        // TODO: Captura los ingresos anuales
        if (count($estudio->ingresos_anuales) > 0) {
            // * Obtengo los ingresos anuales.
            $ingresosAnuales = $estudio->ingresos_anuales()
                ->orderBy('Id_ingresos')
                ->orderBy('mes')
                ->get();
            // * Ordenando los datos de ingresos
            foreach ($ingresosAnuales as $value) {
                $Ingreso = Ingreso::find($value->Id_ingresos);
                $arrayAnualesIngresos[$value->Id_ingresos][$Ingreso->nombre][$value->mes] = [$value->id, $value->monto_conservador];
            }
            // * De lo contrario agarra los mensuales
        } else {
            $estaActivado = true;
            $ingresosMensuales = $estudio->ingresos;
            foreach ($ingresosMensuales as $value) {
                $arrayMensualesIngresos[$value->id][$value->nombre] = $value->escenario_conservador;
            }
        }
        $url = route('plan_de_negocio.proyeccionConservador.store', $plan_de_negocio);

        // TODO: Envió de información a la vista
        return view(
            'plan_financiero.proyeccionAnual',
            [
                'plan_de_negocio' => $plan_de_negocio,
                'titulo' => $titulo,
                'ruta' => $url,
                // TODO: Envió de datos fijos
                'costosAniosFijos' => $arrayAnualesFijos,
                'arrayMenualFijo' => $arrayMensualesFijos,
                // TODO: Envió de datos variables
                'costosAnualesVariables' => $arrayAnualesVariables,
                'arrayMensualVariable' => $arrayMensualesVariables,
                // TODO: Envio de datos ingresos
                'ingresosAnuales' => $arrayAnualesIngresos,
                'arrayMenualIngresos' => $arrayMensualesIngresos,
                // TODO: Envio pasa saber si el boton se vera activado.
                'estaActivado' => $estaActivado
            ]
        );
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
                CostosFijosAnuales::updateOrCreate(
                    ['id' => $value[$i][0]],
                    [
                        'Id_estudio_financiero' => $estudio->id,
                        'Id_costo_fijo' => $key,
                        'mes' => $i + 1,
                        'monto_conservador' => $value[$i][1]
                    ]
                );
            }
        }

        // TODO: Almacenamos o actualizamos los costos variables conservador
        foreach ($costosVariables as $key => $value) {
            for ($i = 0; $i < count($value); $i++) {
                CostosVariablesAnualesConservador::updateOrCreate(
                    ['id' => $value[$i][0]],
                    [
                        'Id_estudio_financiero' => $estudio->id,
                        'Id_costo_variable' => $key,
                        'mes' => $i + 1,
                        'monto_conservador' => $value[$i][1]
                    ]
                );
            }
        }

        // TODO: Almacenamos o actualizamos los ingresos
        foreach ($ingresos as $key => $value) {
            for ($i = 0; $i < count($value); $i++) {
                IngresosAnualesConservador::updateOrCreate(
                    ['id' => $value[$i][0]],
                    [
                        'Id_estudio_financiero' => $estudio->id,
                        'Id_ingresos' => $key,
                        'mes' => $i + 1,
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
