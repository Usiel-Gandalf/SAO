<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg border">
        <div class="modal-content p-1">
            <div class="row justify-content-md-center">
                <div class="col-11">
                    <ul>
                        <li>
                            <strong>TODAS LAS FILAS QUE NO APARECEN EN EL REPORTE SE REGISTRARAN/ACTUALIZARAN SIN PROBLEMA ALGUNO</strong>
                        </li>
                        <li>
                            <p>Si el error es un mensaje similar a este: <strong>The "nombre" field is required</strong> verificar que el nombre de la columna exista,
                                si existe, verificar el campo en la fila que se indica ya que podria estar vacio, no se preocupe, los registros con celdas vacias
                                se omitiran automaticamente pero usted debera de corregir esa informacion para registrarla correctamente
                            </p>
                        </li>
                        <li>
                            <p>Si el error es un mensaje similar a este: <strong>The fol_form has already been taken.</strong> significa que el registro ya existe y
                                se esta intentando registrar nuevamente, no se preocupe ya que se omitiran automaticamente estos registros duplicados
                            </p>
                        </li>
                        <li>
                            <p>Si el error es un mensaje similar a este: <strong>The "nombre" must be an "tipo de dato".</strong> significa que el registro no corresponde
                                a su tipo de dato permitido, quiza esta ingresando letras en lugar de numero o viceversa, verifique sus datos nuevamente, no se preocupe,
                                los registros con estos errores se omitiran, pero usted debera de corregir esa informacion para registrarla correctamente
                            </p>
                        </li>
                    </ul>
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
                    @if(session()->has('failures'))
                    @foreach(session()->get('failures') as $validation)
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
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>