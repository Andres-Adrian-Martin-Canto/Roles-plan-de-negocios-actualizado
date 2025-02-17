<?php

namespace App\Http\Controllers;

use Barryvdh\Snappy\Facades\SnappyPdf as PDF; // Importar la clase PDF correctamente
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

     /**
     * Mostrar la vista previa del organigrama.
     *
     * @param  int  $plan_de_negocio
     * @param  int  $organigrama
     * @return \Illuminate\Http\Response
     */
    
     public function previewPDF($plan_de_negocio, $organigrama)
     {
         // Obtén la instancia del plan de negocio y el organigrama
         $planDeNegocio = Plan_de_negocio::findOrFail($plan_de_negocio);
         $organigrama = Organigrama::findOrFail($organigrama);
     
         // Pasa plan_de_negocio y organigrama a la vista nodos
         $chartHtml = view('nodos', [
             'plan_de_negocio' => $planDeNegocio,  // Ojo: la clave es 'plan_de_negocio'
             'organigrama' => $organigrama
         ])->render();
     
         // Genera el PDF con organigramas.pdf
        
        $pdf = PDF::loadView('organigramas.pdf', [
            'organigrama' => $organigrama,
            'chartHtml' => $chartHtml
        ])->setOption('enable-local-file-access', true);
        return $pdf->inline('organigrama.pdf');
     }
    

   
    public function store(Request $request, Plan_de_negocio $plan_de_negocio)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            // 'archivo' ya no es necesario
        ]);
    
        $data = [
            'plan_de_negocio_id' => $plan_de_negocio->id,
            'nombre' => $request->nombre,
            // 'archivo' no se incluye
        ];
    
        Organigrama::create($data);
    
        return redirect()->route('plan_de_negocio.organigramas.index', $plan_de_negocio)
            ->with('success', 'Organigrama creado exitosamente.');
    }
    

    // Mostrar el formulario para editar un organigrama
    public function edit(Plan_de_negocio $plan_de_negocio, Organigrama $organigrama)
    {
        return view('nodos', compact('plan_de_negocio', 'organigrama'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $organigrama = Organigrama::findOrFail($id);
        $organigrama->update($request->all());

        return response()->json(['message' => 'Organigrama actualizado correctamente.']);
    }

     /**
     * Actualizar el nombre del organigrama.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateNombre(Request $request, $plan_de_negocio, $organigrama)
{
    // Buscar el organigrama por ID
    $organigrama = Organigrama::findOrFail($organigrama);

    // Actualizar el nombre
    $organigrama->nombre = $request->input('nombre');
    $organigrama->save();

    return response()->json(['message' => 'Nombre actualizado correctamente']);
}
    

    // Eliminar un organigrama
    
    public function destroy(Plan_de_negocio $plan_de_negocio, Organigrama $organigrama)
    {
    
        // Eliminar el organigrama de la base de datos
        $organigrama->delete();
    
        return redirect()->route('plan_de_negocio.organigramas.index', $plan_de_negocio)
            ->with('success', 'Organigrama eliminado exitosamente.');
    }

    public function downloadPDF(Plan_de_negocio $plan_de_negocio, Organigrama $organigrama)
    {
        try {
            // Validar que el organigrama pertenece al plan de negocio
            if ($organigrama->plan_de_negocio_id !== $plan_de_negocio->id) {
                return redirect()->back()->with('error', 'Organigrama no encontrado para este Plan de Negocio.');
            }

            

            // Definir el nombre del archivo PDF
            $fileName = 'Organigrama_' . $organigrama->id . '_' . now()->format('Ymd_His') . '.pdf';

            // Retornar el archivo PDF como descarga
            return $pdf->download($fileName);
        } catch (\Exception $e) {
            // Registrar el error
            \Log::error('Error al generar PDF del organigrama: ' . $e->getMessage());

            // Retornar con mensaje de error
            return redirect()->back()->with('error', 'Ocurrió un error al generar el PDF. Inténtalo nuevamente.');
        }
    }
}
