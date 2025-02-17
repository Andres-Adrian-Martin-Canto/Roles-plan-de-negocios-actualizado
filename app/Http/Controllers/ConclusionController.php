<?php

namespace App\Http\Controllers;

use App\Models\Conclusion;
use App\Models\Plan_de_negocio;
use App\Models\Estudio;
use Illuminate\Http\Request;

class ConclusionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio, Estudio $estudio)
    {
        return view('conclusion.index', compact('plan_de_negocio', 'estudio'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Plan_de_negocio $plan_de_negocio, Estudio $estudio)
    {
        return view('conclusion.create', compact('plan_de_negocio', 'estudio'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Plan_de_negocio $plan_de_negocio, Estudio $estudio)
    {
        $validated = $request->validate([
            'conclusion' => 'required',
        ]);

        $conclusion = $estudio->conclusion()->create($validated);

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }

        return redirect()->route($user_route.'plan_de_negocio.estudio.conclusion.index', ['plan_de_negocio' => $plan_de_negocio, 'estudio' => $estudio]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Conclusion $conclusion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conclusion $conclusion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan_de_negocio $plan_de_negocio, Estudio $estudio, Conclusion $conclusion)
    {
        $conclusion = Conclusion::find($estudio->conclusion->id);
        $input = $request->all();
        $conclusion->update($input);

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }
        return redirect()->route($user_route.'plan_de_negocio.estudio.conclusion.index', ['plan_de_negocio' => $plan_de_negocio, 'estudio' => $estudio]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan_de_negocio $plan_de_negocio, Estudio $estudio, Conclusion $conclusion)
    {
        Conclusion::destroy($conclusion->id);
        return back();
    }
}
