<!DOCTYPE html>
<html>
<head>
    <title>Página de Inicio</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="{{ url('/') }}">Peña Taurina "El Jala"</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                <li class
                class="nav-item">
                <a class="nav-link" href="#">Cobros</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mt-5">Bienvenido a la Página de Inicio</h1>
            <p>¡Te damos la bienvenida a la Peña Taurina "El Jala"! Somos un lugar de encuentro para los amantes de la tauromaquia, donde compartimos nuestra pasión por la cultura y tradición taurina.</p>
            <p>Disfruta de un ambiente único y acogedor, donde podrás compartir experiencias, conocer a otros aficionados y estar al tanto de las últimas noticias y eventos taurinos.</p>
            <p>¡No te pierdas nuestras tertulias, conferencias, y actividades relacionadas con el mundo del toro! Únete a nuestra comunidad y vive la emoción de la fiesta brava.</p>
            <img src="https://via.placeholder.com/600x400" class="img-fluid mt-4" alt="Imagen de una peña taurina">
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
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
</html>
