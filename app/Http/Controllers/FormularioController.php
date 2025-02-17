<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use App\Models\Plan_de_negocio;
use App\Models\Estudio;
use App\Models\Poll;
use Illuminate\Http\Request;

class FormularioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Plan_de_negocio $plan_de_negocio, Estudio $estudio, Poll $encuestum)
    {
        $datos = request()->validate([
            'elecciones.*.respuesta_id' => 'required',
            'elecciones.*.pregunta_id' => 'required',
            'formulario.nombre' => 'required',
            'formulario.correo' => 'required',
        ]);

        $formulario = $encuestum->formularios()->create($datos['formulario']);
        $formulario->respuestas()->createMany($datos['elecciones']);

        return view('formulario.success');
        //return redirect()->route('plan_de_negocio.estudio.encuesta.index', compact('plan_de_negocio', 'estudio'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan_de_negocio $plan_de_negocio, Estudio $estudio, Poll $encuestum, $slug)
    {
        $encuestum->load('preguntas.respuestas');
        return view('formulario.show', compact('plan_de_negocio', 'estudio', 'encuestum'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formulario $formulario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formulario $formulario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formulario $formulario)
    {
        //
    }
}
