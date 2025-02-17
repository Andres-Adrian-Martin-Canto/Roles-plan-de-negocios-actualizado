<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Plan_de_negocio;
use App\Models\Estudio;
use Illuminate\Http\Request;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio, Estudio $estudio)
    {
        return view('poll.index', compact('plan_de_negocio', 'estudio'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Plan_de_negocio $plan_de_negocio, Estudio $estudio)
    {
        return view('poll.create', compact('plan_de_negocio', 'estudio'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Plan_de_negocio $plan_de_negocio, Estudio $estudio)
    {
        $validated = $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
        ]);

        $estudio->encuestas()->create($validated);

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }

        return redirect()->route($user_route.'plan_de_negocio.estudio.encuesta.index', ['plan_de_negocio' => $plan_de_negocio, 'estudio' => $estudio]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan_de_negocio $plan_de_negocio, Estudio $estudio, Poll $encuestum)
    {
        //dd($plan_de_negocio, $estudio, $encuestum);
        return view('poll.show', compact('plan_de_negocio', 'estudio', 'encuestum'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poll $poll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poll $poll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan_de_negocio $plan_de_negocio, Estudio $estudio, Poll $encuestum)
    {
        Poll::destroy($encuestum->id);

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }
        return redirect()->route($user_route.'plan_de_negocio.estudio.encuesta.index', ['plan_de_negocio' => $plan_de_negocio, 'estudio' => $estudio]);
    }
}
