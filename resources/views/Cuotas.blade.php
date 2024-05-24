<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cuotas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="{{ url('/') }}">Peña Taurina "El Jala"</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="socioDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Socio
                    </a>
                    <div class="dropdown-menu" aria-labelledby="socioDropdown">
                        <a class="dropdown-item" href="{{ url('/socios') }}">Socios</a>
                        <a class="dropdown-item" href="{{ route('crearSocio') }}">Crear Nuevo Socio</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cuotas') }}">Cuotas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pagos</a>
                </li>
                <li class class="nav-item">
                    <a class="nav-link" href="#">Cobros</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
        </div>
    </nav>
    <div class="container mt-5">
        <h1>Lista de Cuotas</h1>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre Cuota</th>
                        <th>Importe Cuota</th>
                        <th>Fecha Cuota</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cuotas as $cuota)
                        <tr>
                            <td>{{ $cuota->nombrecuota }}</td>
                            <td>{{ $cuota->importecuota }} €</td>
                            <td>{{ $cuota->fecha_cuota }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#editarCuota{{ $cuota->idcuota }}">Modificar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @foreach ($cuotas as $cuota)
        <div class="modal fade" id="editarCuota{{ $cuota->idcuota }}" tabindex="-1" role="dialog"
            aria-labelledby="editarCuotaLabel{{ $cuota->idcuota }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarCuotaLabel{{ $cuota->idcuota }}">Modificar Cuota</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="alertMessage{{ $cuota->idcuota }}" class="alert" role="alert"
                            style="display: none;"></div>
                        <form id="editarForm{{ $cuota->idcuota }}" data-id="{{ $cuota->idcuota }}"
                            action="{{ route('modificarCuota', ['id' => $cuota->idcuota]) }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="nombrecuota">Nombre de la Cuota</label>
                                <input type="text" class="form-control" id="nombrecuota" name="nombrecuota"
                                    value="{{ $cuota->nombrecuota }}">
                            </div>
                            <div class="form-group">
                                <label for="importecuota">Importe de la Cuota</label>
                                <input type="number" class="form-control" id="importecuota" name="importecuota"
                                    value="{{ $cuota->importecuota }}" step="1">
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Cambiar el evento de 'click' a 'hover' para el menú desplegable
            $('.nav-item.dropdown').hover(function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
            }, function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
            });
        });
    </script>
</body>
<script>
    $(document).ready(function() {
        $('form').submit(function(event) {
            event.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var formData = form.serialize();

            $.post(url, formData, function(response) {
                if (response.success) {
                    showMessage(response.success, 'success', form.data('id'));
                } else if (response.warning) {
                    showMessage(response.warning, 'warning', form.data('id'));
                }
            }).fail(function(xhr) {
                if (xhr.status === 400) {
                    showMessage(xhr.responseJSON.warning, 'warning', form.data('id'));
                } else {
                    showMessage(xhr.responseJSON.error, 'danger', form.data('id'));
                }
            });
        });

        function showMessage(message, type, cuotaId) {
            var alertMessage = $('#alertMessage' + cuotaId);
            alertMessage.removeClass('alert-success alert-warning alert-danger').addClass('alert-' + type).text(
                message).show();
            setTimeout(function() {
                alertMessage.hide();
                $('#editarCuota' + cuotaId).modal('hide');
                location.reload();
            }, 2000);
        }
    });
</script>

</html>
