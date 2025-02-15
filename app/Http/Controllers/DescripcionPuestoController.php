<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DescripcionPuesto;
use App\Models\Plan_de_negocio;

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
        // Obtener los niveles supervisados dinámicamente
        $tacticos = $plan_de_negocio->descripcionpuesto()
            ->where('nivel', 'tactico')
            ->select('id', 'unidad_administrativa')
            ->get();

        return view('descripciones.create', compact('plan_de_negocio', 'tacticos'));
    }

    /**
     * Almacenar una nueva descripción de puesto.
     */
    public function store(Request $request, Plan_de_negocio $plan_de_negocio)
    {
        try {
            // Validación
            $validatedData = $request->validate([
                'nivel' => 'required|string',
                'codigo' => 'required|string|max:255',
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
                'supervisa_a' => 'nullable|array',
                'comunicacion_interna' => 'nullable|string',
                'comunicacion_externa' => 'nullable|string',
                'estado_civil' => 'nullable|string',
                'edad' => 'nullable|string',
                'genero' => 'nullable|string',
                'requisitos_generales' => 'nullable|string',
                'habilidades_fisicas' => 'nullable|string',
                'habilidades_mentales' => 'nullable|string',
            ]);
    
            if (isset($validatedData['supervisa_a'])) {
                $validatedData['supervisa_a'] = json_encode($validatedData['supervisa_a']);
            } else {
                $validatedData['supervisa_a'] = json_encode([]);
            }
    
            // Agregar el ID del plan de negocio
            $validatedData['plan_de_negocio_id'] = $plan_de_negocio->id;
    
            // Crear el registro
            DescripcionPuesto::create($validatedData);
    
            // Redirección con mensaje de éxito
            return redirect()->route('plan_de_negocio.descripciones.index', $plan_de_negocio)
                ->with('success', 'Descripción de puesto creada exitosamente.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Verificar si el error corresponde al campo 'codigo'
            if ($e->validator->errors()->has('codigo')) {
                return back()
                    ->withInput()
                    ->with('codigoDuplicado', 'El código ingresado ya existe. Por favor, ingresa un código diferente.');
            }
    
            // Si ocurre otro error de validación, lanzarlo de nuevo
            throw $e;
        }
    }
    
    /**
     * Mostrar el formulario para editar una descripción de puesto existente.
     */
     public function edit(Plan_de_negocio $plan_de_negocio, $id)
    {
        $descripcion = DescripcionPuesto::findOrFail($id);
        // quitar el dato actual dependiendo su nivel, ejemplo si es tactico cuando haga la busqueda no me tragia el id actual del que se esta editando
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
            'supervisa_a' => 'nullable|array',
            'comunicacion_interna' => 'nullable|string',
            'comunicacion_externa' => 'nullable|string',
            'estado_civil' => 'nullable|string',
            'edad' => 'nullable|string',
            'genero' => 'nullable|string',
            'requisitos_generales' => 'nullable|string',
            'habilidades_fisicas' => 'nullable|string',
            'habilidades_mentales' => 'nullable|string',
        ], [
            'codigo.unique' => 'El código ya está en uso. Por favor, elija otro código.',
        ]);

        if (isset($validatedData['supervisa_a'])) {
            $validatedData['supervisa_a'] = json_encode($validatedData['supervisa_a']);
        } else {
            $validatedData['supervisa_a'] = json_encode([]);
        }

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
