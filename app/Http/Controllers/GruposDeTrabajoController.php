<?php

namespace App\Http\Controllers;

use App\Models\GruposDeTrabajo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class GruposDeTrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, GruposDeTrabajo $gruposDeTrabajo)
    {
        $grupo = GruposDeTrabajo::find(request('grupo'));

        if(auth()->user()->rol == 'asesor'){
            $array_usuarios = json_decode($grupo->integrantes);

            if(request('search')){
                $usuarios = DB::table('users')->where([['rol','!=','admin'],['rol','!=','asesor'],['email', 'like', '%' . request('search') . '%']])->get();

                //dd($agregar_usuario);

                return view('asesor.grupos_de_trabajo.index', compact('grupo', 'usuarios', 'array_usuarios'));
            }else{
                return view('asesor.grupos_de_trabajo.index', compact('grupo'));
            }
        }else{
            if(request('search')){
                $grupos = GruposDeTrabajo::join('users', 'grupos_de_trabajos.user_id', '=', 'users.id')
                    ->select('grupos_de_trabajos.id', 'user_id', 'nombre_grupo', 'descripcion', 'integrantes', 'name')
                    ->where([['rol','!=','admin'],[$request->tipo, 'like', '%' . request('search') . '%']])
                    ->paginate(5);

                return view('admin.grupos_de_trabajo.index', compact('grupos'));

            }else{
                $grupos = GruposDeTrabajo::join('users', 'grupos_de_trabajos.user_id', '=', 'users.id')
                    ->select('grupos_de_trabajos.id', 'user_id', 'nombre_grupo', 'descripcion', 'integrantes', 'name')->paginate(5);

                return view('admin.grupos_de_trabajo.index', compact('grupos'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('asesor.grupos_de_trabajo.create');
    }

    public function busqueda(GruposDeTrabajo $gruposDeTrabajo)
    {
        $grupo = GruposDeTrabajo::find(request('grupo'));
        //dd($grupo);

        //dd("estas buscando");
        $array_usuarios = json_decode($grupo->integrantes);

        if(request('search')){
            $usuarios = DB::table('users')->where([['rol','!=','admin'],['rol','!=','asesor'],['email', 'like', '%' . request('search') . '%']])->get();

            //dd("estas buscando");

            return view('admin.grupos_de_trabajo.busqueda', compact('grupo', 'usuarios', 'array_usuarios'));
        }else{
            return view('admin.grupos_de_trabajo.busqueda', compact('grupo'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_grupo' => 'required',
            'descripcion' => 'required',
            'integrantes' => 'required',
        ]);

        $user = Auth::user();

        //dd($request, $validated);
        $user->grupos_de_trabajo()->create($validated);
        $user->save();

        return redirect()->route('asesor.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(GruposDeTrabajo $gruposDeTrabajo)
    {
        $grupo = GruposDeTrabajo::find(request('grupo'));
        $array_usuarios = json_decode($grupo->integrantes);

        $users = User::whereIn('id', $array_usuarios)->get();

        if(auth()->user()->rol == 'asesor'){
            return view('asesor.grupos_de_trabajo.show', compact('grupo','users'));
        }else{
            return view('admin.grupos_de_trabajo.show', compact('grupo','users'));          
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GruposDeTrabajo $gruposDeTrabajo)
    {
        $grupo = GruposDeTrabajo::find(request('grupo'));

        if(auth()->user()->rol == 'asesor'){
            return view('asesor.grupos_de_trabajo.edit', compact('grupo'));
        }else{
            return view('admin.grupos_de_trabajo.edit', compact('grupo'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GruposDeTrabajo $gruposDeTrabajo, string $usuario)
    {
        $grupo = GruposDeTrabajo::find(request('grupo'));
        $usuario = (int)(request('usuario'));

        $array_usuarios = json_decode($grupo->integrantes);

        if(!in_array($usuario, $array_usuarios)){
            array_push($array_usuarios, $usuario);

            $users = User::whereIn('id', $array_usuarios)->get();

            //dd($users);

            $array_usuarios = json_encode($array_usuarios);            
            $grupo->integrantes = $array_usuarios;
            
            $grupo->save();
        }
        
        if(auth()->user()->rol == 'asesor'){
            return redirect()->route('grupo.show', [
                "grupo" => $grupo
            ]);
        }else{
            return redirect()->route('grupo_show_admin', [
                "grupo" => $grupo
            ]);
        }
    }

    public function details_update(Request $request, GruposDeTrabajo $grupo)
    {
        $validated = $request->validate([
            'nombre_grupo' => 'required',
            'descripcion' => 'required',
        ]);

        $grupo->update($validated);

        if(auth()->user()->rol == 'asesor'){
            return redirect()->route('grupo.show', [
                "grupo" => $grupo
            ]);
        }else{
            return redirect()->route('grupo_show_admin', [
                "grupo" => $grupo
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GruposDeTrabajo $gruposDeTrabajo, User $user)
    {
        $grupo = GruposDeTrabajo::find(request('grupo'));
        $usuario = (int)request('usuario');

        $array_usuarios = json_decode($grupo->integrantes);

        $array_usuarios = array_diff($array_usuarios, array($usuario));
        $array_usuarios = array_values($array_usuarios);
        $array_usuarios = json_encode($array_usuarios);

        $grupo->integrantes = $array_usuarios;

        $grupo->save();
        return back();
        
    }

    public function complete_destroy(GruposDeTrabajo $gruposDeTrabajo)
    {
        $grupo_id = request('grupo');

        GruposDeTrabajo::destroy($grupo_id);
        return back(); 
    }
}
