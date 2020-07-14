<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>@yield('title', 'SAO')</title>
    <link href="https://www.gob.mx/cms/uploads/image/file/488329/favicon.png" rel="shortcut icon">
</head>

<body>
    <nav style="background-color: #0c231e; color: #fff;" class="navbar navbar-expand-lg">
        <button class="navbar-toggler bg-color-white" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-white"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">

            <a data-v-4a3754a3="" href="https://www.gob.mx" target="_blank" class="navbar-brand"><img data-v-4a3754a3="" src="https://framework-gb.cdn.gob.mx/landing/img/logoheader.svg" alt="logo gobierno de méxico" class="logos" style="width: 8rem; margin-top: -2%; margin-bottom: -2%; margin-left: 0;"></a>
            <a class="navbar-brand">SAO</a>

            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 ">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="{{url('/home')}}">Inicio<span class="sr-only">(current)</span></a>
                </li>
                @if(Auth::user()->rol == 1)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Usuarios
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('/admin')}}">Administradores</a>
                        <a class="dropdown-item" href="{{url('/boss')}}">Jefes</a>
                    </div>
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
                        Subir Entidades
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('importRegions')}}">Regiones</a>
                        <a class="dropdown-item" href="{{route('importMunicipalities')}}">Municipios</a>
                        <a class="dropdown-item" href="{{route('importLocalities')}}">Localidades</a>
                        <a class="dropdown-item" href="{{route('importSchools')}}">Escuelas</a>
                        <a class="dropdown-item" href="{{route('importScholars')}}">Becarios/Titulares</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Subir Becas
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('importBasics')}}">Educacion basica</a>
                        <a class="dropdown-item" href="{{route('importMediums')}}">Media superior</a>
                        <a class="dropdown-item" href="{{route('importReissue')}}">Reexpediciones EMS</a>
                        <a class="dropdown-item" href="{{route('importHigers')}}">Educacion superior</a>
                    </div>
                </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Becas
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('/basicEducation')}}">Educacion basica</a>
                        <a class="dropdown-item" href="{{url('/mediumEducation')}}">Educacion media superior</a>
                        <a class="dropdown-item" href="{{url('/higerEducation')}}">Jovenes escribiendo el futuro</a>
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
                            @if(Auth::user()->rol == 1)
                            <a class="dropdown-item badge badge-success" href="{{route('adminProfile')}}">Perfil</a>
                            @endif
                            @if(Auth::user()->rol == 0)
                            <a class="dropdown-item badge badge-success" href="{{route('bossProfile')}}">Perfil</a>
                            @endif

                            <a class="dropdown-item badge badge-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Cerrar Sesion') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </div>
            </div>
        </div>
    </nav>

    <section>
        @yield('main')
    </section>






    <!-- Footer -->

    <!-- Footer -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>