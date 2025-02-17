<?php

namespace App\Http\Controllers;

use App\Models\Foda;
use App\Models\Plan_de_negocio;
use Illuminate\Http\Request;

class FodaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        $plan_de_negocio->load('fodas');
        $foda_data = [
            "amenazas" => $plan_de_negocio->fodas()->where('tipo','Amenazas')->get(),
            "fortalezas" => $plan_de_negocio->fodas()->where('tipo','Fortalezas')->get(),
            "debilidades" => $plan_de_negocio->fodas()->where('tipo','Debilidades')->get(),
            "oportunidades" => $plan_de_negocio->fodas()->where('tipo','Oportunidades')->get(),
        ];
        
        //dd($foda_data['amenazas'][0]->descripcion);

        return view('foda.index',[
            'plan_de_negocio' => $plan_de_negocio,
            'foda_data' => $foda_data,
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
    public function store(Request $request,Plan_de_negocio $plan_de_negocio)
    {
        //
        $validated = $request->validate([
            'tipo' => 'required',
            'descripcion' => 'required',
        ]);

        $plan_de_negocio->fodas()->create($validated);

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }
        return redirect()->route(
            $user_route.'plan_de_negocio.foda.index',
            [
                'plan_de_negocio' => $plan_de_negocio,
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Foda $foda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Foda $foda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan_de_negocio $plan_de_negocio, Foda $foda)
    {
        //Recuperamos los valores enviados desde el formulario de actualizacion
        $validated = $request->validate([
            "tipo" => "required",
            "descripcion" => "required"
        ]);
        
        // Aplicamos la actualizacion al elemento en la base de datos
        $foda->update($validated);

        // Redireccionamos de regreso a la pantalla inicial del foda
        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }
        return redirect()->route(
            $user_route.'plan_de_negocio.foda.index',
            [
                'plan_de_negocio' => $plan_de_negocio,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan_de_negocio $plan_de_negocio, Foda $foda)
    {
        $foda->delete();
        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }
        return redirect()->route(
            $user_route.'plan_de_negocio.foda.index',
            [
                'plan_de_negocio' => $plan_de_negocio,
            ]
        );
    }
}
