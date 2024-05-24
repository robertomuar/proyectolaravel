<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuotas;
use Illuminate\Http\Response;

class CuotasController extends Controller
{
    public function cuotas()
    {
        $cuotas = Cuotas::all();
        return view('cuotas', compact('cuotas'));
    }

    public function update(Request $request, $id)
    {
        $cuota = Cuotas::findOrFail($id);

        // Obtener los valores actuales de la cuota
        $currentNombreCuota = $cuota->nombrecuota;
        $currentImporteCuota = $cuota->importecuota;

        // Obtener los valores enviados en el formulario
        $newNombreCuota = $request->input('nombrecuota', $currentNombreCuota);
        $newImporteCuota = intval($request->input('importecuota', $currentImporteCuota));

        // Verificar si los valores son diferentes de los actuales
        if ($newNombreCuota !== $currentNombreCuota || $newImporteCuota !== $currentImporteCuota) {
            // Si se modificó, actualiza los campos correspondientes
            $cuota->nombrecuota = $newNombreCuota;
            $cuota->importecuota = $newImporteCuota;
            // Actualiza el campo fecha_cuota al año actual
            $cuota->fecha_cuota = date('Y');

            // Guardar los cambios en la base de datos
            if ($cuota->save()) {
                // Si la cuota se guarda correctamente y se modificó, devuelve una respuesta JSON con el mensaje de éxito
                return response()->json(['success' => 'Cuota actualizada exitosamente']);
            } else {
                // Si hay un problema al guardar la cuota, devuelve una respuesta JSON con el mensaje de error
                return response()->json(['error' => 'Hubo un problema al actualizar la cuota. Por favor, inténtalo de nuevo.'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            // Si los valores son iguales a los actuales, devuelve una respuesta JSON con el mensaje de advertencia
            return response()->json(['warning' => 'Los valores de la cuota son iguales a los actuales. No se realizaron cambios.'], Response::HTTP_BAD_REQUEST);
        }
    }
}
