<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DescripcionPuesto;
use App\Models\Plan_de_negocio;
use Illuminate\Support\Facades\Log;

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
        // Log::info('Datos recibidos para crear una nueva descripción de puesto:', $request->all());
        try {
            // Validación
            $validatedData = $request->validate([
                'nivel' => 'required|string',
                'codigo' => 'required|string|max:255',
                'unidad_administrativa' => 'required|string|max:255',
                'nombre_puesto' => 'required|string|max:255',
                'otros_nombres_puestos' => 'nullable|string|max:255',
                'numero_plaza' => 'required|integer',
                'jornada_laboral' => 'required|string|max:255',
                'otros_jornada_laboral' => 'nullable|string|max:255',
                'salario_minimo' => 'required|numeric',
                'salario_maximo' => 'required|numeric',
                'puesto_superior' => 'nullable|integer|max:255',
                'puesto_subornidado' => 'nullable|array',
                'comunicacion_interna' => 'nullable|string|max:255',
                'comunicacion_externa' => 'nullable|string|max:255',
                'objetivos_puesto' => 'required|string',
                'descripcion_generica' => 'required|string',
                'descripcion_especifica' => 'required|string',
                'forma_pago' => 'nullable|string|max:255',
                'estado_civil' => 'nullable|string|max:255',
                'edad' => 'nullable|numeric',
                'nacionalidad' => 'nullable|string|max:255',
                'sexo' => 'nullable|string|max:255',
                'estatura' => 'nullable|string|max:255',
                'antecedentes' => 'nullable|string|max:255',
                'experiencia' => 'nullable|string|max:255',
                'habilidades_fisicas' => 'nullable|string|max:255',
                'habilidades_mentales' => 'nullable|string|max:255',
            ]);

            if (isset($validatedData['puesto_subornidado'])) {
                $validatedData['puesto_subornidado'] = json_encode($validatedData['puesto_subornidado']);
            } else {
                $validatedData['puesto_subornidado'] = json_encode([]);
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
        // Excluir el registro actual según su nivel para no traer el id actual del que se está editando
        $estrategicos = $plan_de_negocio->descripcionpuesto()
            ->where('nivel', 'estrategico')
            ->where('id', '!=', $descripcion->id)
            ->select('id', 'unidad_administrativa')
            ->get();
        $tactico = $plan_de_negocio->descripcionpuesto()
            ->where('nivel', 'tactico')
            ->where('id', '!=', $descripcion->id)
            ->select('id', 'unidad_administrativa')
            ->get();
        $operativo = $plan_de_negocio->descripcionpuesto()
            ->where('nivel', 'operativo')
            ->where('id', '!=', $descripcion->id)
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
            'otros_nombres_puestos' => 'nullable|string|max:255',
            'numero_plaza' => 'required|integer',
            'jornada_laboral' => 'required|string|max:255',
            'otros_jornada_laboral' => 'nullable|string|max:255',
            'salario_minimo' => 'required|numeric',
            'salario_maximo' => 'required|numeric',
            'puesto_superior' => 'nullable|integer|max:255',
            'puesto_subornidado' => 'nullable|array',
            'comunicacion_interna' => 'nullable|string|max:255',
            'comunicacion_externa' => 'nullable|string|max:255',
            'objetivos_puesto' => 'required|string',
            'descripcion_generica' => 'required|string',
            'descripcion_especifica' => 'required|string',
            'forma_pago' => 'nullable|string|max:255',
            'estado_civil' => 'nullable|string|max:255',
            'edad' => 'nullable|numeric',
            'nacionalidad' => 'nullable|string|max:255',
            'sexo' => 'nullable|string|max:255',
            'estatura' => 'nullable|string|max:255',
            'antecedentes' => 'nullable|string|max:255',
            'experiencia' => 'nullable|string|max:255',
            'habilidades_fisicas' => 'nullable|string|max:255',
            'habilidades_mentales' => 'nullable|string|max:255',
        ], [
            'codigo.unique' => 'El código ya está en uso. Por favor, elija otro código.',
        ]);

        if (isset($validatedData['puesto_subornidado'])) {
            $validatedData['puesto_subornidado'] = json_encode($validatedData['puesto_subornidado']);
        } else {
            $validatedData['puesto_subornidado'] = json_encode([]);
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
