<?php

namespace App\Http\Controllers;

use App\Models\Organigrama;
use App\Models\Plan_de_negocio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganigramaController extends Controller
{
    // Mostrar la lista de organigramas
    public function index(Plan_de_negocio $plan_de_negocio)
    {
        $organigramas = $plan_de_negocio->organigramas;
        return view('organigramas.index', compact('organigramas', 'plan_de_negocio'));
    }

    // Subir un nuevo organigrama
    public function store(Request $request, Plan_de_negocio $plan_de_negocio)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'archivo' => 'required|file|mimes:pdf',
        ]);

        // Almacenar el archivo y registrar el organigrama
        $path = $request->file('archivo')->store('organigramas');

        Organigrama::create([
            'plan_de_negocio_id' => $plan_de_negocio->id,
            'nombre' => $request->nombre,
            'archivo' => $path
        ]);

        return redirect()->route('plan_de_negocio.organigramas.index', $plan_de_negocio)
            ->with('success', 'Organigrama subido exitosamente.');
    }

    // Mostrar el formulario para editar un organigrama
    public function edit(Plan_de_negocio $plan_de_negocio, Organigrama $organigrama)
    {
        return view('organigramas.edit', compact('plan_de_negocio', 'organigrama'));
    }

    // Actualizar un organigrama existente
    public function update(Request $request, Plan_de_negocio $plan_de_negocio, Organigrama $organigrama)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'archivo' => 'nullable|file|mimes:pdf',
        ]);

        // Si el usuario sube un nuevo archivo, lo reemplazamos
        if ($request->hasFile('archivo')) {
            // Eliminar el archivo viejo
            Storage::delete($organigrama->archivo);

            // Almacenar el nuevo archivo
            $path = $request->file('archivo')->store('organigramas');
            $organigrama->archivo = $path;
        }

        // Actualizar el nombre
        $organigrama->nombre = $request->nombre;
        $organigrama->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('plan_de_negocio.organigramas.index', $plan_de_negocio)
            ->with('success', 'Organigrama actualizado exitosamente.');
    }

    // Eliminar un organigrama
    public function destroy(Plan_de_negocio $plan_de_negocio, Organigrama $organigrama)
    {
        // Eliminar el archivo del servidor
        Storage::delete($organigrama->archivo);

        // Eliminar el organigrama de la base de datos
        $organigrama->delete();

        return redirect()->route('plan_de_negocio.organigramas.index', $plan_de_negocio)
            ->with('success', 'Organigrama eliminado exitosamente.');
    }

    // Descargar un organigrama
    public function download(Organigrama $organigrama)
    {
        // Descargar el archivo desde el almacenamiento
        return Storage::download($organigrama->archivo);
    }
}
