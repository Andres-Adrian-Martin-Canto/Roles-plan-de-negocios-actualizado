<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DescripcionPuesto;
use App\Models\Plan_de_negocio;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Foreach_;

class DescripcionPuestoController extends Controller
{
    /**
     * Mostrar la lista de descripciones de puesto.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        $arraydatos = [];
        // Obtener las descripciones asociadas al plan de negocio ordenadas por nivel
        $descripciones = $plan_de_negocio->descripcionpuesto()
            ->orderByRaw("FIELD(nivel, 'estrategico', 'tactico', 'operativo')")
            ->get();
        return view('descripciones.index', compact('descripciones', 'plan_de_negocio'));
    }

    /**
     * Mostrar el formulario para crear una nueva descripción de puesto.
     */
    public function create(Plan_de_negocio $plan_de_negocio)
    {
        return view('descripciones.create', compact('plan_de_negocio'));
    }

    /**
     * Almacenar una nueva descripción de puesto.
     */
    public function store(Request $request, Plan_de_negocio $plan_de_negocio)
    {
        // Log::info($request);
        $validatedData = $request->validate([
            'nivel' => 'required|string',
            'codigo' => 'required|string|max:255|unique:descripcion_puestos,codigo',
            'unidad_administrativa' => 'required|string|max:255',
            'nombre_puesto' => 'required|string|max:255',
            'descripcion_generica' => 'required|string',
            'descripcion_especifica' => 'required|string',
            'objetivos_puesto' => 'required|string',
            'salario_minimo' => 'required|numeric',
            'salario_maximo' => 'required|numeric',
            'jornada_laboral' => 'required|string',
            'numero_plaza' => 'required|integer',
            'reporta_a' => 'nullable|integer',
            'supervisa_a' => 'nullable|integer',
            'comunicacion_interna' => 'nullable|string',
            'comunicacion_externa' => 'nullable|string',
            'estado_civil' => 'nullable|string',
            'edad' => 'nullable|integer',
            'genero' => 'nullable|string',
            'requisitos_generales' => 'nullable|string',
            'habilidades_fisicas' => 'nullable|string',
            'habilidades_mentales' => 'nullable|string',
        ]);

        // Asociar la descripción al plan de negocio
        if (DescripcionPuesto::where('codigo', $request->codigo)->exists()) {
            return redirect()->back()->with('codigoDuplicado', 'El código ingresado ya está en uso. Por favor, use otro.');
        }

        // Asociar la descripción al plan de negocio
        $plan_de_negocio->descripcionpuesto()->create($validatedData);

        return redirect()->route('plan_de_negocio.descripciones.index', $plan_de_negocio)
            ->with('success', 'Descripción de puesto creada exitosamente.');
    }


    /**
     * Mostrar el formulario para editar una descripción de puesto existente.
     */
    public function edit(Plan_de_negocio $plan_de_negocio, $id)
    {
        $descripcion = DescripcionPuesto::findOrFail($id);
    
        // Obtener los niveles supervisados dinámicamente
        $estrategicos = $plan_de_negocio->descripcionpuesto()
            ->where('nivel', 'estrategico')
            ->select('id', 'unidad_administrativa')
            ->get();
    
        $tactico = $plan_de_negocio->descripcionpuesto()
            ->where('nivel', 'tactico')
            ->select('id', 'unidad_administrativa')
            ->get();
    
        $operativo = $plan_de_negocio->descripcionpuesto()
            ->where('nivel', 'operativo')
            ->select('id', 'unidad_administrativa')
            ->get();
    
        return view('descripciones.edit', compact('descripcion', 'plan_de_negocio', 'estrategicos', 'tactico', 'operativo'));
    }
    
    /**
     * Actualizar una descripción de puesto existente.
     */

    public function update(Request $request, Plan_de_negocio $plan_de_negocio, $id)
    {
        $descripcion = DescripcionPuesto::findOrFail($id);

        $validatedData = $request->validate([
            'nivel' => 'required|string',
            'codigo' => 'required|string|max:255|unique:descripcion_puestos,codigo,' . $descripcion->id,
            'unidad_administrativa' => 'required|string|max:255',
            'nombre_puesto' => 'required|string|max:255',
            'descripcion_generica' => 'required|string',
            'descripcion_especifica' => 'required|string',
            'objetivos_puesto' => 'required|string',
            'salario_minimo' => 'required|numeric',
            'salario_maximo' => 'required|numeric',
            'jornada_laboral' => 'required|string',
            'numero_plaza' => 'required|integer',
            'reporta_a' => 'nullable|string',
            'supervisa_a' => 'nullable|string',
            'comunicacion_interna' => 'nullable|string',
            'comunicacion_externa' => 'nullable|string',
            'estado_civil' => 'nullable|string',
            'edad' => 'nullable|integer',
            'genero' => 'nullable|string',
            'requisitos_generales' => 'nullable|string',
            'habilidades_fisicas' => 'nullable|string',
            'habilidades_mentales' => 'nullable|string',
        ], [
            'codigo.unique' => 'El código ya está en uso. Por favor, elija otro código.',
        ]);
        Log::info($request);
        $descripcion->update($validatedData);

        return redirect()->route('plan_de_negocio.descripciones.index', ['plan_de_negocio' => $plan_de_negocio])
            ->with('success', 'Descripción de puesto actualizada exitosamente.');
    }

    /**
     * Eliminar una descripción de puesto.
     */
    public function destroy(Plan_de_negocio $plan_de_negocio, $id)
    {
        $descripcion = DescripcionPuesto::findOrFail($id);
        $descripcion->delete();

        return redirect()->route('plan_de_negocio.descripciones.index', $plan_de_negocio)
            ->with('success', 'Descripción de puesto eliminada exitosamente.');
    }


}
