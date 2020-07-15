<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg border">
        @if(session('failures'))
        <div class="modal-content p-1">
            <div class="row justify-content-md-center text-center">
                <div class="col-11">
               <strong>TODAS LAS FILAS QUE NO APARECEN EN EL REPORTE SE REGISTRARAN/ACTUALIZARAN SIN PROBLEMA ALGUNO</strong>
               <br>
                </div>
            </div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Fila en el documento</th>
                        <th scope="col">Columna</th>
                        <th scope="col">Error</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach(session('failures') as $validation)
                    <tr>
                        <th>{{$validation->row()}}</th>
                        <td>{{$validation->attribute()}}</td>
                        <td>
                            <ul>
                                @foreach($validation->errors() as $e)
                                <li>{{$e}}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>