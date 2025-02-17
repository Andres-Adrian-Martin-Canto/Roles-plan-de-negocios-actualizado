<?php

namespace App\Http\Controllers;

use App\Models\Cultura_organizacional;
use App\Models\Plan_de_negocio;
use Illuminate\Http\Request;

class CulturaOrganizacionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        $plan_de_negocio->load('cultura_organizacional');
        $edit = $plan_de_negocio->cultura_organizacional()->exists();

        // if($plan_de_negocio->cultura_organizacional()->exists()){
        //     $edit = true;
        // }

        return view('cultura_organizacional.index', [
            "plan_de_negocio" => $plan_de_negocio,
            "edit" => $edit
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
        $validated = $request->validate([
            "mision" => "required",
            "vision" => "required",
            "objetivos" => "required",
            "valores" => "required",
            "metas" => "required",
        ]);

        $plan_de_negocio->cultura_organizacional()->create($validated);

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }
        return redirect()->route($user_route.'plan_de_negocio.cultura_organizacional.index', [
            "plan_de_negocio" => $plan_de_negocio,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cultura_organizacional $cultura_organizacional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cultura_organizacional $cultura_organizacional)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan_de_negocio $plan_de_negocio, Cultura_organizacional $cultura_organizacional)
    {
        $validated = $request->validate([
            "mision" => "required",
            "vision" => "required",
            "objetivos" => "required",
            "valores" => "required",
            "metas" => "required",
        ]);

        $cultura_organizacional->update($validated);

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }
        return redirect()->route($user_route.'plan_de_negocio.cultura_organizacional.index', [
            "plan_de_negocio" => $plan_de_negocio,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cultura_organizacional $cultura_organizacional)
    {
        //
    }
}
