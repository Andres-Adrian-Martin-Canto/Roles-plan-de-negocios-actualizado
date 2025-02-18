<?php

namespace App\Http\Controllers;

use App\Models\Nodo;
use Illuminate\Http\Request;

class NodoController extends Controller
{
    // Mostrar la vista principal
    public function index()
    {
        return view('nodos');
    }

    public function getNodos(Request $request)
    {
        $organigramaId = $request->query('organigrama_id');

        // Cargar todos los niveles de hijos recursivamente
        $nodos = Nodo::with('childrenRecursive')
                     ->whereNull('parent_id')
                     ->where('organigrama_id', $organigramaId)
                     ->get();

        return response()->json($nodos);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'puesto' => 'required|string|max:255',
            'codigo' => 'required|string|max:255',
            'foto' => 'nullable|string|max:255',
            'parent_id' => 'nullable|integer|exists:nodos,id',
            'organigrama_id' => 'required|integer|exists:organigramas,id',
        ]);

        $nodo = Nodo::create([
            'puesto' => $request->puesto,
            'codigo' => $request->codigo,
            'foto' => $request->foto,
            'parent_id' => $request->parent_id,
            'organigrama_id' => $request->organigrama_id,
        ]);

    return response()->json($nodo, 201);
}

    public function destroy($id)
    {
        $nodo = Nodo::findOrFail($id);
        $nodo->delete();
        return response()->json(null, 204);
    }

    public function guardarOrganigrama(Request $request)
    {
        $validatedData = $request->validate([
            'organigrama_id' => 'required|integer|exists:organigramas,id',
            'nodos' => 'required|array',
            'nodos.*.id' => 'required|integer', // Requerir 'id' para cada nodo
            'nodos.*.puesto' => 'required|string|max:255',
            'nodos.*.codigo' => 'required|string|max:255',
            'nodos.*.foto' => 'nullable|string',
            'nodos.*.parent_id' => 'nullable|integer|exists:nodos,id',
        ]);

        $organigramaId = $validatedData['organigrama_id'];
        $nodos = $validatedData['nodos'];

        // Limpiar nodos existentes
        Nodo::where('organigrama_id', $organigramaId)->delete();

        // Guardar nodos directamente con IDs temporales
        $nodosMap = []; // Mapa de IDs temporales a IDs reales

        // Primer paso: Crear todos los nodos con parent_id = null
        foreach ($nodos as $nodo) {
            $nuevoNodo = Nodo::create([
                'organigrama_id' => $organigramaId,
                'puesto' => $nodo['puesto'],
                'codigo' => $nodo['codigo'],
                'foto' => $nodo['foto'] ?? null,
                'parent_id' => null, // Temporalmente null
            ]);
            $nodosMap[$nodo['id']] = $nuevoNodo->id; // Mapear ID temporal a ID real
        }

        // Segundo paso: Actualizar parent_id utilizando el mapa
        foreach ($nodos as $nodo) {
            if (isset($nodo['parent_id'])) {
                // Verificar si el parent_id es un ID temporal
                $parentId = $nodo['parent_id'];
                if (isset($nodosMap[$parentId])) {
                    $realParentId = $nodosMap[$parentId];
                } else {
                    $realParentId = $parentId; // ID real existente
                }

                Nodo::where('id', $nodosMap[$nodo['id']])->update([
                    'parent_id' => $realParentId
                ]);
            }
        }

        return response()->json(['message' => 'Datos guardados exitosamente.']);
    }

     //Base 64
     public function uploadPhoto(Request $request, $id)
     {
         $request->validate([
             'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
         ]);
     
         $nodo = Nodo::findOrFail($id);
     
         if ($request->hasFile('photo')) {
             $file = $request->file('photo');
             $imageData = base64_encode(file_get_contents($file->getRealPath()));
             $nodo->foto = $imageData;
             $nodo->save();
     
             return response()->json(['message' => 'Foto subida exitosamente.', 'path' => $imageData, 'id' => $id]);
         }
     
         return response()->json(['message' => 'Error al subir la foto.'], 400);
     }
    
}