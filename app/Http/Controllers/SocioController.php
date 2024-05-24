<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Socio;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;

class SocioController extends Controller
{
    public function socios()
    {
        // Obtener los datos de los socios
        $socios = Socio::all();

        // Verificar si hay al menos un socio
        if ($socios->isNotEmpty()) {
            // Pasar la variable $socio a la vista parcial solo si hay al menos un socio
            $socio = $socios->first();
        } else {
            // Si no hay socios, asignar null a la variable $socio
            $socio = null;
        }

        // Pasar los datos de los socios a la vista principal
        return view('socios', compact('socios', 'socio'));
    }

    public function edit($id)
    {
        $socio = Socio::findOrFail($id);
        return view('editar-socio', compact('socio'));
    }

    public function update(Request $request, $id)
    {
        // Buscar el socio en la base de datos
        $socio = Socio::findOrFail($id);

        // Validar los datos del formulario
        $request->validate([
            'nombreSocio' => 'required|string|max:255',
            'apellidoSocio' => 'required|string|max:255',
            'telefonoSocio' => ['nullable', 'string', 'max:20', function ($attribute, $value, $fail) {
                // Validar que el teléfono tenga exactamente 9 dígitos si se proporciona
                if (!empty($value) && strlen($value) !== 9) {
                    $fail('El teléfono debe tener exactamente 9 dígitos.');
                }
            }],
            'emailSocio' => 'nullable|email|max:255',
        ]);

        // Verificar si los datos del formulario son iguales a los datos existentes
        if (
            $request->nombreSocio === $socio->nombre_socio &&
            $request->apellidoSocio === $socio->apellido1_socio &&
            $request->telefonoSocio === $socio->tlf_socio &&
            $request->emailSocio === $socio->email_socio
        ) {

            // No se realizaron cambios, mostrar mensaje de advertencia
            Session::flash('warning', 'No se han realizado cambios en el socio.');
        } else {
            // Los datos son diferentes, proceder con la actualización

            // Actualizar los campos del socio con los datos del formulario
            $socio->nombre_socio = $request->input('nombreSocio');
            $socio->apellido1_socio = $request->input('apellidoSocio');
            $socio->tlf_socio = $request->input('telefonoSocio');
            $socio->email_socio = $request->input('emailSocio');

            // Actualizar la fecha de actualización con la fecha y hora actuales
            $socio->updated_at = now();

            // Guardar los cambios en la base de datos
            $socio->save();

            // Mensaje de éxito en la sesión
            Session::flash('success', 'Socio actualizado correctamente.');
        }

        // Redirigir a la página anterior con los mensajes de alerta
        return redirect()->back();
    }

    public function eliminar($idsocio)
    {
        try {
            $socio = Socio::where('idsocio', $idsocio)->firstOrFail();
            $socio->delete();

            // Mensaje de éxito en la sesión
            Session::flash('success', 'Socio eliminado correctamente.');
        } catch (QueryException $e) {
            // Manejar otras excepciones de base de datos si es necesario
            Session::flash('error', 'Error al eliminar el socio.');
        }

        // Redirigir a la página anterior con el mensaje de alerta
        return redirect()->route('socios');
    }

    public function crearSocio()
    {
        return view('crearsocio');
    }

    public function guardarSocio(Request $request)
    {
        $request->validate([
            'nombre_socio' => 'required|string|max:255',
            'apellido1_socio' => 'required|string|max:255',
            'tlf_socio' => 'nullable|string|max:20',
            'email_socio' => 'nullable|email|max:255',
        ]);

        try {
            // Verificar si el socio ya existe
            $existe = Socio::where('nombre_socio', $request->nombre_socio)
                ->where('apellido1_socio', $request->apellido1_socio)
                ->exists();

            if ($existe) {
                return redirect()->back()->with('error', 'Socio ya existente.');
            }

            // Crear un nuevo objeto Socio con los datos del formulario
            $socio = new Socio();
            $socio->nombre_socio = $request->nombre_socio;
            $socio->apellido1_socio = $request->apellido1_socio;
            $socio->tlf_socio = $request->tlf_socio;
            $socio->email_socio = $request->email_socio;

            // Guardar el nuevo socio en la base de datos
            $socio->save();

            // Redirigir a una página de éxito o a cualquier otra página que desees
            return redirect()->route('socios')->with('success', 'Nuevo socio agregado correctamente.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Socio ya existente.');
        }
    }
}
