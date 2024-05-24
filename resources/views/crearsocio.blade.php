<!DOCTYPE html>
<html>

<head>
    <title>Crear Nuevo Socio</title>
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
                    <a class="nav-link" href="{{ route('cuotas')}}">Cuotas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pagos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Cobros</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
        </div>
    </nav>

    <div class="container" style="padding-top: 80px;">
        <div class="row">
            <div class="col-md-12">
                <h1>Crear Nuevo Socio</h1>
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = "{{ route('socios') }}"; // Redireccionar a la página de socios después de 3 segundos
                    }, 3000); // 3000 milisegundos = 3 segundos
                </script>
                @endif
                @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = "{{ route('socios') }}"; // Redireccionar a la página de socios después de 3 segundos
                    }, 3000); // 3000 milisegundos = 3 segundos
                </script>
                @endif
                <form id="guardarSocioForm" action="{{ route('guardarSocio') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre_socio">Nombre</label>
                        <input type="text" class="form-control" id="nombre_socio" name="nombre_socio" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido1_socio">Apellido</label>
                        <input type="text" class="form-control" id="apellido1_socio" name="apellido1_socio" required>
                    </div>
                    <div class="form-group">
                        <label for="tlf_socio">Teléfono</label>
                        <input type="tel" class="form-control" id="tlf_socio" name="tlf_socio">
                    </div>
                    <div class="form-group">
                        <label for="email_socio">Email</label>
                        <input type="email" class="form-control" id="email_socio" name="email_socio">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Socio</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Función para mostrar u ocultar el menú desplegable
            $('.nav-item.dropdown').hover(function() {
                // Comprobar si el menú está cerrado antes de mostrarlo
                if (!$(this).hasClass('show')) {
                    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
                }
            }, function() {
                // Comprobar si el menú está abierto antes de ocultarlo
                if (!$(this).hasClass('show')) {
                    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
                }
            });
        });
    </script>
    
</body>

</html>
