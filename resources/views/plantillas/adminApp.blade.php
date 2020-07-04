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
            <a class="navbar-brand">SAO</a>

            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 ">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="{{url('/home')}}">Inicio<span class="sr-only">(current)</span></a>
                </li>
                @if(Auth::user()->rol == 1)
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{url('/user')}}">Usuarios</a>
                </li>
                @endif
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
                @if(Auth::user()->rol == 1)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Subir
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('importEntities')}}">Entidades</a>
                        <a class="dropdown-item" href="{{route('importScholars')}}">Becarios/Titulares</a>
                        <a class="dropdown-item" href="{{route('importBasics')}}">Educacion basica</a>
                        <a class="dropdown-item" href="{{route('importMediums')}}">Media superior</a>
                        <a class="dropdown-item" href="{{route('importHigers')}}">Educacion superior</a>
                    </div>
                </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Universos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('/basicEducation')}}">Educacion basica</a>
                        <a class="dropdown-item" href="{{url('/mediumEducation')}}">Educacion media superior</a>
                        <a class="dropdown-item" href="{{url('/higerEducation')}}">Jovenes escribiendo el futuro</a>
                        <a class="dropdown-item" href="">Reporte EB</a>
                        <a class="dropdown-item" href="">Reporte EMS</a>
                        <a class="dropdown-item" href="">Reporte JEF</a>
                    </div>
                </li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <div class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span class="caret text-light">{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" class="">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Cerrar Sesion') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="">Perfil</a>
                        </div>
                    </li>
                </div>
            </div>
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