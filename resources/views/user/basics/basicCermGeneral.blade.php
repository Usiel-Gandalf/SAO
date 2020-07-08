<div class="container shadow p-3 mb-5 bg-white rounded mt-5">

    <div class="row justify-content-md-center mb-4">
        <h4>CERM</h4>
    </div>

    <div class="container mt-2">
        <div class="row">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Enero-Febrero</th>
                        <th scope="col">Marzo-Abril</th>
                        <th scope="col">Mayo-Junio</th>
                        <th scope="col">Septiembre-Octubre</th>
                        <th scope="col">Noviembre-Diciembre</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pendientes</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 1)->where('status', 0)->count()}}</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 2)->where('status', 0)->count()}}</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 3)->where('status', 0)->count()}}</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 4)->where('status', 0)->count()}}</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 5)->where('status', 0)->count()}}</td>
                    </tr>
                    <tr>
                        <td>Entregados</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 1)->where('status', 1)->count()}}</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 2)->where('status', 1)->count()}}</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 3)->where('status', 1)->count()}}</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 4)->where('status', 1)->count()}}</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 5)->where('status', 1)->count()}}</td>
                    </tr>
                    <tr>
                        <td>No entregado|No localizado</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 1)->where('status', 2)->count()}}</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 2)->where('status', 2)->count()}}</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 3)->where('status', 2)->count()}}</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 4)->where('status', 2)->count()}}</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 5)->where('status', 2)->count()}}</td>
                    </tr>
                    <tr>
                        <td>No entregado|Por baja</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 1)->where('status', 3)->count()}}</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 2)->where('status', 3)->count()}}</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 3)->where('status', 3)->count()}}</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 4)->where('status', 3)->count()}}</td>
                        <td>{{$reports->where('type', 1)->where('bimester', 5)->where('status', 3)->count()}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col foat-right">
            <a class="btn btn-success float-right" href="">PDF</a>
        </div>
    </div>
</div>