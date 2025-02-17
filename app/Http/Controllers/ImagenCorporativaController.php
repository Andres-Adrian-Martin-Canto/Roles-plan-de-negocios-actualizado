<?php

namespace App\Http\Controllers;

use App\Models\Imagen_corporativa;
use App\Models\Plan_de_negocio;
use Illuminate\Http\Request;

class ImagenCorporativaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        return view('imagen_corporativa.index', compact('plan_de_negocio'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Plan_de_negocio $plan_de_negocio)
    {
        return view('imagen_corporativa.create', compact('plan_de_negocio'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Plan_de_negocio $plan_de_negocio)
    {
        $request->validate([
            'logotipo' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            'justificacion_logo' => 'required',
            'nombre_corporativo' => 'required',
            'justificacion_nombre' => 'required',
            'eslogan' => 'required',
            'justificacion_eslogan' => 'required',
        ]);
        
        $data = $request->only('justificacion_logo', 'nombre_corporativo', 'justificacion_nombre', 'eslogan', 'justificacion_eslogan');

        if ( $request->hasFile('logotipo') )
        {
            $file = $request->file('logotipo');
            $destinationPath = 'images/logotipos/';
            $filename = time(). '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('logotipo')->move($destinationPath, $filename);
            $data['logotipo'] = $destinationPath . $filename;
        }

        $plan_de_negocio->imagenes_corporativas()->create($data);

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }

        return redirect()->route($user_route.'plan_de_negocio.imagen_corporativa.index', compact('plan_de_negocio'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Imagen_corporativa $imagen_corporativa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan_de_negocio $plan_de_negocio, Imagen_corporativa $imagen_corporativa)
    {
        return view('imagen_corporativa.edit', compact('plan_de_negocio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan_de_negocio $plan_de_negocio, Imagen_corporativa $imagen_corporativa)
    {
        //dd($request->hasFile('logotipo'));

        $request->validate([
            'justificacion_logo' => 'required',
            'nombre_corporativo' => 'required',
            'justificacion_nombre' => 'required',
            'eslogan' => 'required',
            'justificacion_eslogan' => 'required',
        ]);

        $data = $request->only('justificacion_logo', 'nombre_corporativo', 'justificacion_nombre', 'eslogan', 'justificacion_eslogan');

        if ( $request->hasFile('logotipo') )
        {
            $request->validate([
                'logotipo' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            ]);

            $file = $request->file('logotipo');
            $destinationPath = 'images/logotipos/';
            $filename = time(). '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('logotipo')->move($destinationPath, $filename);

            $image_path = public_path().'/'.$imagen_corporativa->logotipo;
            if (@getimagesize($image_path)){
                unlink($image_path);
            }

            $data['logotipo'] = $destinationPath . $filename;
        }else{
            $data['logotipo'] = $imagen_corporativa->logotipo;
        }
        
        $plan_de_negocio->imagenes_corporativas->update($data);

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }
        return redirect()->route($user_route.'plan_de_negocio.imagen_corporativa.index', compact('plan_de_negocio'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan_de_negocio $plan_de_negocio, Imagen_corporativa $imagen_corporativa)
    {
        $image_path = public_path().'/'.$imagen_corporativa->logotipo;
        if (@getimagesize($image_path)){
            unlink($image_path);
        }
        Imagen_corporativa::destroy($imagen_corporativa->id);
        return back();
    }
}
