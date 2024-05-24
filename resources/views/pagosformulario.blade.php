<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Pagos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        form div {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        select,
        input[type="date"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
        .checkbox-group {
        display: flex;
        flex-wrap: wrap;
    }
    .checkbox-group label {
        display: flex;
        align-items: center;
        margin-bottom: 5px;
    }
    .checkbox-group label input {
        margin-right: 5px;
    }
    </style>
</head>

<body>


    <form action="{{ route('pagos.store') }}" method="POST">
        @csrf
        <div>
            <label for="idsocio">Socio:</label>
            <select name="idsocio" id="idsocio" required>
                @foreach($socios as $socio)
                    <option value="{{ $socio->idsocio }}">{{ $socio->nombre_socio }} {{ $socio->apellido1_socio}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="fechpago_de_cuota">Fecha de Pago:</label>
            <input type="date" name="fechpago_de_cuota" id="fechpago_de_cuota" required>
        </div>
        <div class="checkbox-group">
            @foreach($cuotas as $cuota)
                <label>
                    <input type="checkbox" name="idcuotas[]" value="{{ $cuota->idcuota }}" data-monto="{{ $cuota->importecuota }}">
                    {{ $cuota->nombrecuota }}
                </label>
            @endforeach
        </div>
        
        <div>
            <label for="total_pago">Total Pago:</label>
            <input type="text" name="total_pago" id="total_pago" readonly>
        </div>
        <div>
            <label for="socios_pagados">Socios Pagados:</label>
            <select name="socios_pagados[]" id="socios_pagados" multiple required>
                @foreach($socios as $socio)
                    <option value="{{ $socio->idsocio }}">{{ $socio->nombre_socio }}  {{ $socio->apellido1_socio}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Registrar Pago</button>
    </form>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        const totalPagoInput = document.getElementById('total_pago');

        // Escucha cambios en la selección de cuotas
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                let totalPago = 0;
                // Suma los importes de las cuotas seleccionadas
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        totalPago += parseFloat(checkbox.getAttribute('data-monto'));
                    }
                });
                // Muestra el total en el campo de total_pago
                totalPagoInput.value = totalPago.toFixed(2); // Formato de dos decimales
            });
        });
    });
</script>


</html>
