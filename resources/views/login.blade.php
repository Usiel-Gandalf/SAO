<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>SAO</title>
</head>
<div class="container mt-auto">
    <br><br>
    <div class="row justify-content-md-center mt-5">
        <h1>Iniciar sesion SAO</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <center>
                    <div class="col-md-5 border">
                        <form action="" method="get" class="mt-3">
                            @csrf
                            <div class="form-group">
                                <input id="id" class="form-control mx-1" type="text" name="id" placeholder="Usuario">
                            </div>
                            <div class="form-group">
                                <input id="numberRegion" class="form-control mx-1" type="text" name="numberRegion" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Iniciar sesion">
                            </div>
                        </form>
                    </div>
                </center>
            </div>
        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('js/app.js')}}"></script>
</body>

</html>