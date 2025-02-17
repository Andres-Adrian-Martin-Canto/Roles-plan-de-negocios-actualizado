<?php

namespace App\Http\Controllers;

use PgSql\Lob;
use App\Models\Proyeccion;
use Illuminate\Http\Request;
use App\Models\Plan_de_negocio;
use Illuminate\Support\Facades\Log;

use function Ramsey\Uuid\v1;

class ProyeccionController extends Controller
{
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        // $proyecciones = Proyeccion::all();
        // $totalSueldos = $proyecciones->sum('total');
        $arraydescripciondepuesto = $plan_de_negocio->descripcionpuesto;
        $haydatosanules = count($plan_de_negocio->proyecciondesueldomensual->first()->proyecciondesueldoanual);
        
        $arraydatos = [];
       
        $totaldelossueldos = 0;
        foreach ($arraydescripciondepuesto as  $value) {
            $totaldelossueldos += ($value->sueldomensual)
                ? $value->sueldomensual->total : $value->salario_maximo;
            array_push($arraydatos, [$value->id, $value->nombre_puesto, $value->numero_plaza, ($value->sueldomensual)
                ? $value->sueldomensual->sueldo : $value->salario_maximo, ($value->sueldomensual) ? $value->sueldomensual->id : 0]);
        }

        $ruta = route('plan_de_negocio.proyecciones.store', $plan_de_negocio);

        return view('proyecciones.index', compact('arraydatos', 'totaldelossueldos', 'plan_de_negocio', 'ruta', 'haydatosanules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Opcional si tienes un formulario separado para crear nuevas proyecciones

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Plan_de_negocio $plan_de_negocio)
    {

        $plan_de_negocio->proyecciondesueldomensual()->delete();
        foreach ($request->all() as $value) {
            Proyeccion::create(
                [
                    'plan_de_negocio_id' => $plan_de_negocio->id,
                    'descripcion_de_puesto_id' => $value[0],
                    'sueldo' => $value[3],
                    'total' => $value[4]
                ]
            );
            // Log::info($value);
            // Proyeccion::create([
            //     'plan_de_negocio_id'=>$plan_de_negocio->id,
            //     'descripcion_de_puesto_id'=>$value[0],
            //     'sueldo'=>$value[3],
            //     'total'=>$value[4]

            // ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}



    public function resumen(Plan_de_negocio $plan_de_negocio)
    {
        // Obtener todas las proyecciones y calcular los totales

        $sueldos = $plan_de_negocio->proyecciondesueldomensual;
        $total = 0;
        foreach ($sueldos as $value) {
            $total += $value->total;
        }
        // Pasar los datos a la vista
        return view('proyecciones.resumen', compact('plan_de_negocio', 'total'));
    }
}
