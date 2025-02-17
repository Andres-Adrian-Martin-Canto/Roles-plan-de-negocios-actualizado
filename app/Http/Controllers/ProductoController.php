<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\User;
use App\Models\Plan_de_negocio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Plan_de_negocio $plan_de_negocio)
    {
        if(request('search')){
            $listaproductos = $plan_de_negocio->productos()->where('nombre', 'like', '%' . request('search') . '%')->paginate(4);
        } else {
            $listaproductos = $plan_de_negocio->productos()->paginate(4);
        }
        
        return view('producto.index', compact('plan_de_negocio', 'listaproductos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Plan_de_negocio $plan_de_negocio)
    {
        return view('producto.create', compact('plan_de_negocio'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Plan_de_negocio $plan_de_negocio)
    {
        $validated = $request->validate([
            'nombre' => 'required',
            'precio_de_costo' => 'required',
            'precio_de_venta' => 'required',
            'descripcion' => 'required',
        ]);

        $producto = $plan_de_negocio->productos()->create($validated);

        $user_route = auth()->user()->rol;
        if($user_route == 'admin' || $user_route == 'asesor'){
            $user_route = $user_route.'_';
        }else{
            $user_route = '';
        }

        return redirect()->route($user_route.'plan_de_negocio.producto.index', compact('plan_de_negocio'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan_de_negocio $plan_de_negocio, Producto $producto)
    {
        return view('producto.edit', compact('plan_de_negocio', 'producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan_de_negocio $plan_de_negocio, Producto $producto)
    {
        $validated = $request->validate([
            'nombre' => 'required',
            'precio_de_costo' => 'required',
            'precio_de_venta' => 'required',
            'descripcion' => 'required',
        ]);

        $producto->update($validated);

        $listaproductos = $plan_de_negocio->productos()->paginate(4);
        return view('producto.index', compact('plan_de_negocio', 'listaproductos'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan_de_negocio $plan_de_negocio, Producto $producto)
    {
        Producto::destroy($producto->id);

        $listaproductos = $plan_de_negocio->productos()->paginate(4);
        return view('producto.index', compact('plan_de_negocio', 'listaproductos'));
    }

    public function search(Producto $producto)
    {
        //
    }
}
