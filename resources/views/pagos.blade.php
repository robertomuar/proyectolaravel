<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pagos</title>
</head>
<body>
    <h1>Lista de Pagos</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID Pago</th>
                <th>Socio</th>
                <th>Fecha de Pago</th>
                <th>Cuota</th>
                <th>Total Pago</th>
                <th>Socios Pagados</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pagos as $pago)
                <tr>
                    <td>{{ $pago->idpago }}</td>
                    <td>{{ $pago->socio->nombre_socio }}</td>
                    <td>{{ $pago->fechpago_de_cuota }}</td>
                    <td>{{ $pago->cuota->nombrecuota }}</td>
                    <td>{{ $pago->total_pago }}</td>
                    <td>
                        <ul>
                            @foreach($pago->socios as $socioPagado)
                                <li>{{ $socioPagado->nombre }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
