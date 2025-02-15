<?php

namespace App\Http\Controllers;

use PgSql\Lob;
use App\Models\Proyeccion;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;
use App\Models\Plan_de_negocio;

use Illuminate\Support\Facades\Log;
use App\Models\ProyeccionCincoAnios;
use App\Models\proyecciondesueldoanual;

class ProyeccionController extends Controller
{
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        // $proyecciones = Proyeccion::all();
        // $totalSueldos = $proyecciones->sum('total');
        $arraydescripciondepuesto = $plan_de_negocio->descripcionpuesto;
        if (count($plan_de_negocio->descripcionpuesto) === 0) {
            return redirect()->back()->with('mensaje', 'No se pueden ingresar hasta que se guarden los datos de sueldo.');
        }
        if ($plan_de_negocio->proyecciondesueldomensual->isNotEmpty()) {
            $haydatosanules = count($plan_de_negocio->proyecciondesueldomensual->first()->proyecciondesueldoanual);
        } else {
            $haydatosanules = 0;
        }
        $arraydatos = [];

        $totaldelossueldos = 0;
        foreach ($arraydescripciondepuesto as  $value) {
            $totaldelossueldos += ($value->sueldomensual)
                ? $value->sueldomensual->total : $value->salario_maximo * $value->jornada_laboral;
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
        // dd(count($plan_de_negocio->proyecciondesueldomensual));
        $sueldos = $plan_de_negocio->proyecciondesueldomensual;
        
        if (count($plan_de_negocio->descripcionpuesto) === 0) {
            return redirect()->back()->with('mensaje', 'No se pueden ingresar hasta que se guarden los datos de sueldo.');
        }
        if (count($plan_de_negocio->descripcionpuesto) > count($sueldos)) {
            return redirect()->back()->with('mensaje', 'No se pueden ingresar hasta que se guarden los datos de sueldo.');
        }
        
        $totalmensual = 0;
        $totalanual= 0;
        $totalcincoanios= 0;
        foreach ($sueldos as $value) {
       
            $datosanual = proyecciondesueldoanual::where('proyección_de_sueldos', $value->id)->get();
            $datoscincoanios = ProyeccionCincoAnios::where('proyección_de_sueldos', $value->id)->get();
            foreach ($datosanual as $anual) {
                $totalanual += $anual->sueldo_total_por_mes;
            }
            foreach ($datoscincoanios as  $cincoanios) {
                $totalcincoanios += $cincoanios->sueldo_total_anual;
            }
            $totalmensual += $value->total;
            
        }
        // Pasar los datos a la vista
        return view('proyecciones.resumen', compact('plan_de_negocio', 'totalmensual','totalanual','totalcincoanios'));
    }
    
}
