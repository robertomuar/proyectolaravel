<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Socio;
use App\Models\Cuotas;
use App\Models\PagoCuotaSocio;

class PagoController extends Controller
{
    public function create()
    {
        $socios = Socio::all();
        $cuotas = Cuotas::all();
        return view('pagosformulario', compact('socios', 'cuotas'));
    }


    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'idsocio' => 'required|exists:socios,idsocio',
            'fechpago_de_cuota' => 'required|date',
            'idcuotas' => 'required|array',
            'idcuotas.*' => 'exists:cuotas,idcuota',
            'total_pago' => 'required|numeric',
            'socios_pagados' => 'required|array',
            'socios_pagados.*' => 'exists:socios,idsocio',
        ]);

        // Crear un nuevo pago
        $pago = new Pago();
        $pago->idsocio = $request->idsocio;
        $pago->fechpago_de_cuota = date('Y-m-d', strtotime($request->fechpago_de_cuota));
        $pago->total_pago = $request->total_pago;
        $pago->save(); // Guardamos primero el pago para obtener su ID

        // Obtener los IDs de las cuotas seleccionadas
        $idcuotas = $request->input('idcuotas', []);

        // Asociar las cuotas al pago
        $pago->cuotas()->sync($idcuotas);

        // Guardar los socios pagados en la tabla pivot
        $idsociosPagados = $request->input('socios_pagados', []);
        foreach ($idsociosPagados as $idsocioPagado) {
            PagoCuotaSocio::create([
                'idsociopagado' => $idsocioPagado,
                'idpago' => $pago->idpago,
            ]);
        }

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->route('pagos.index')->with('success', 'Pago registrado correctamente.');
    }
    public function index()
    {
        $pagos = Pago::with('socios')->get();
        return view('pagos', compact('pagos'));
    }
}
