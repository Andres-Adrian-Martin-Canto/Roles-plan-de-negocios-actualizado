<?php

namespace App\Http\Controllers;

use App\Models\Generalidades;
use App\Models\Plan_de_negocio;
use Illuminate\Http\Request;
use DB;

class GeneralidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        if(auth()->user()->rol == "admin"){

            return view('generalidades.index', compact('plan_de_negocio'));
        }else{
            $plan_de_negocio->load('generalidades');
            return view('generalidades.index', compact('plan_de_negocio'));
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
        //dd($request);
        $seccion = '';
        if ($request->input('antecedentes') != null){
            $seccion = 'Antecedentes';
        }else if ($request->input('descripcion_producto') != null){
            $seccion = 'Producto';
        }else{
            $seccion = 'Aspectos';
        }
        //dd($yopi);

        $validated = $request->validate([
            'antecedentes' => 'nullable',
            'descripcion_producto' => 'nullable',
            'aspectos_innovadores' => 'nullable',
        ]);

        $plan_de_negocio->generalidades()->create($validated);

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }

        return redirect()->route($user_route.'plan_de_negocio.generalidades.index',compact('plan_de_negocio', 'seccion'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Generalidades $generalidades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Generalidades $generalidades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan_de_negocio $plan_de_negocio, Generalidades $generalidades, string $plan_id='0')
    {
        $seccion= '';
        if ($request->input('antecedentes') != null){
            $seccion = 'Antecedentes';
        }else if ($request->input('descripcion_producto') != null){
            $seccion = 'Producto';
        }else{
            $seccion = 'Aspectos';
        }

        $validated = $request->validate([
            'antecedentes' => 'nullable',
            'descripcion_producto' => 'nullable',
            'aspectos_innovadores' => 'nullable',
        ]);

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }

        $plan_de_negocio->generalidades->update($validated);
        return redirect()->route($user_route.'plan_de_negocio.generalidades.index',compact('plan_de_negocio', 'seccion'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Plan_de_negocio $plan_de_negocio, Generalidades $generalidades)
    {
        $seccion= '';
        if ($request->input('action') == "antecedentes") {
            $seccion = 'Antecedentes';
            $antecedentes = $plan_de_negocio->generalidades;
            $antecedentes->antecedentes = null;
            $antecedentes->update();

        } else if ($request->input('action') == "producto") {
            $seccion = 'Producto';
            $producto = $plan_de_negocio->generalidades;
            $producto->descripcion_producto= null;
            $producto->update();

        } else if ($request->input('action') == "aspectos") {
            $seccion = 'Aspectos';
            $aspectos = $plan_de_negocio->generalidades;
            $aspectos->aspectos_innovadores = null;
            $aspectos->update();
        }

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }
        return redirect()->route($user_route.'plan_de_negocio.generalidades.index',compact('plan_de_negocio', 'seccion'));

    }
}
