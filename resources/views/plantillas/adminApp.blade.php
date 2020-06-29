<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>@yield('title', 'SAO')</title>
</head>

<body style="margin:0px;
height:100%;">
    <style type="text/css">
        html,
        body {
            margin: 0px;
            height: 100%;
        }
    </style>
    <nav style="background-color: #0c231e; color: #fff;" class="navbar navbar-expand-lg">
        <button class="navbar-toggler bg-color-bla" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand">Bienestar Oaxaca</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 ">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="{{url('/')}}">Inicio<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{url('/user')}}">Usuarios</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ver
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('/region')}}">Regiones</a>
                        <a class="dropdown-item" href="{{url('/municipality')}}">Municipios</a>
                        <a class="dropdown-item" href="{{url('/locality')}}">Localidades</a>
                        <a class="dropdown-item" href="{{url('/school')}}">Escuelas</a>
                        <a class="dropdown-item" href="{{url('/scholar')}}">Becarios</a>
                        <a class="dropdown-item" href="{{url('/titular')}}">Titulares</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Subir
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('importEntities')}}">Entidades</a>
                        <a class="dropdown-item" href="{{route('importScholars')}}">Becarios/Titulares</a>
                        <a class="dropdown-item" href="{{route('importBasic')}}">Educacion basica</a>
                        <a class="dropdown-item" href="{{route('importMedium')}}">Media superior</a>
                        <a class="dropdown-item" href="{{route('importHiger')}}">Educacion superior</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Universos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('/basicEducation')}}">Educacion basica</a>
                        <a class="dropdown-item" href="">Educacion media superior</a>
                        <a class="dropdown-item" href="">Jovenes escribiendo el futuro</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Perfil</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <button class="btn btn-danger my-2 my-sm-0" type="submit">Cerrar sesion</button>
            </form>
        </div>
    </nav>

    <section style="margin:20px;">
        <div class="container">
            @yield('main')
        </div>
    </section>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>