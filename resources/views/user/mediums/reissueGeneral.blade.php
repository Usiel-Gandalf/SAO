<div class="row justify-content-md-center mb-4">
     <h4>REEXPEDICIONES</h4>
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
                     <td>{{$reissueBim1->where('status', 0)->count()}}</td>
                     <td>{{$reissueBim2->where('status', 0)->count()}}</td>
                     <td>{{$reissueBim3->where('status', 0)->count()}}</td>
                     <td>{{$reissueBim4->where('status', 0)->count()}}</td>
                     <td>{{$reissueBim5->where('status', 0)->count()}}</td>
                 </tr>
                 <tr>
                     <td>Entregados</td>
                     <td>{{$reissueBim1->where('status', 1)->count()}}</td>
                     <td>{{$reissueBim2->where('status', 1)->count()}}</td>
                     <td>{{$reissueBim3->where('status', 1)->count()}}</td>
                     <td>{{$reissueBim4->where('status', 1)->count()}}</td>
                     <td>{{$reissueBim5->where('status', 1)->count()}}</td>
                 </tr>
                 <tr>
                     <td>No entregado|No localizado</td>
                     <td>{{$reissueBim1->where('status', 2)->count()}}</td>
                     <td>{{$reissueBim2->where('status', 2)->count()}}</td>
                     <td>{{$reissueBim3->where('status', 2)->count()}}</td>
                     <td>{{$reissueBim4->where('status', 2)->count()}}</td>
                     <td>{{$reissueBim5->where('status', 2)->count()}}</td>
                 </tr>
                 <tr>
                     <td>No entregado|Por baja</td>
                     <td>{{$reissueBim1->where('status', 3)->count()}}</td>
                     <td>{{$reissueBim2->where('status', 3)->count()}}</td>
                     <td>{{$reissueBim3->where('status', 3)->count()}}</td>
                     <td>{{$reissueBim4->where('status', 3)->count()}}</td>
                     <td>{{$reissueBim5->where('status', 3)->count()}}</td>
                 </tr>
             </tbody>
         </table>
     </div>
 </div>