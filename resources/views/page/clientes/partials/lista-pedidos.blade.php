 <div class="tab-pane fade show active profile-overview" id="profile-overview">
     <p class="small fst-italic">En esta sección puedes ver el estatus de tus pedidos</p>

     <h5 class="card-title">Pedidos</h5>
     <!-- Small tables -->
     {{-- <table class="table table-sm">
         <thead>
             <tr>
                 <th scope="col">#</th>
                 <th scope="col">Name</th>
                 <th scope="col">Position</th>
                 <th scope="col">Age</th>
                 <th scope="col">Start Date</th>
             </tr>
         </thead>
         <tbody>
             <tr>
                 <th scope="row">1</th>
                 <td>Brandon Jacob</td>
                 <td>Designer</td>
                 <td>28</td>
                 <td>2016-05-25</td>
             </tr>
             <tr>
                 <th scope="row">2</th>
                 <td>Bridie Kessler</td>
                 <td>Developer</td>
                 <td>35</td>
                 <td>2014-12-05</td>
             </tr>
             <tr>
                 <th scope="row">3</th>
                 <td>Ashleigh Langosh</td>
                 <td>Finance</td>
                 <td>45</td>
                 <td>2011-08-12</td>
             </tr>
             <tr>
                 <th scope="row">4</th>
                 <td>Angus Grady</td>
                 <td>HR</td>
                 <td>34</td>
                 <td>2012-06-11</td>
             </tr>
             <tr>
                 <th scope="row">5</th>
                 <td>Raheem Lehner</td>
                 <td>Dynamic Division Officer</td>
                 <td>47</td>
                 <td>2011-04-19</td>
             </tr>
         </tbody>
     </table> --}}
     <!-- End small tables -->

     <div class="col-lg-12 table-responsive">

         <!-- Tabla de pedidos (lista) -->
         <table class="table table-hover  bg-white mt-2">
             <thead>
                 <tr class="table-info text-white">
                     <th scope="col">#</th>
                     <th scope="col">Código del pedido</th>
                     <th scope="col">Cliente</th>
                     <th scope="col">Precio</th>
                     <th scope="col" class="text-center">Estatus</th>
                     <th scope="col">Acciones</th>
                 </tr>
             </thead>
             <tbody>

                 @foreach ($pedidos as $key => $pedido)
                     <tr>
                         <th scope="row">{{ ($pedidos->currentPage() - 1) * $pedidos->perPage() + $key + 1 }}
                         </th>
                         <td>{{ $pedido->codigo }}</td>
                         <td>
                             {{ $pedido->nombres_cliente . ' ' . $pedido->apellidos_cliente }} <br>
                             {{ $pedido->nacionalidad_cliente . '-' . $pedido->cedula_cliente }}

                         </td>
                         <td>{{ number_format($pedido->total_a_pagar, 2, ',', '.') }}$</td>
                         <td
                             class=" text-center
                                    {{ $pedido->estatus == 'PENDIENTE' ? 'table-danger' : '' }}    
                                    {{ $pedido->estatus == 'APROBADO' ? 'table-success' : '' }}    
                                    {{ $pedido->estatus == 'PAGO VERIFICADO' ? 'table-success' : '' }}    
                                    {{ $pedido->estatus == 'EN PROCESO' ? 'table-warning' : '' }}    
                                    {{ $pedido->estatus == 'ENTREGADO' ? 'table-primary' : '' }}    
                                    {{ $pedido->estatus == 'RECHAZADO' ? 'table-secondary' : '' }}  
                                    {{ $pedido->estatus == 'PAGO RECHAZADO' ? 'table-danger' : '' }}  
                                    ">
                             <button
                                 class="fw-bold btn
                                        {{ $pedido->estatus == 'PENDIENTE' ? 'btn-danger' : '' }}    
                                        {{ $pedido->estatus == 'APROBADO' ? 'btn-success' : '' }}    
                                        {{ $pedido->estatus == 'PAGO VERIFICADO' ? 'btn-success' : '' }}    
                                        {{ $pedido->estatus == 'EN PROCESO' ? 'btn-warning' : '' }}    
                                        {{ $pedido->estatus == 'ENTREGADO' ? 'btn-primary' : '' }}    
                                        {{ $pedido->estatus == 'RECHAZADO' ? 'btn-secondary' : '' }}    
                                        {{ $pedido->estatus == 'PAGO RECHAZADO' ? 'btn-danger' : '' }}    
                            ">
                                 {{ $pedido->estatus }}
                             </button>
                         </td>


                         <td>
                             @include('page.clientes.partials.modal-show')
                            
                         </td>
                     </tr>
                 @endforeach

             </tbody>
             <tfoot>
                 <tr>

                     <td colspan="10" class="text-center table-secondary">
                         Total de pedidos: {{ $pedidos->total() }} |
                         <a href="{{ route('admin.pedidos.index') }}" class="text-primary">
                             Ver todo
                         </a>
                         <br>
                     </td>
                 </tr>
             </tfoot>
         </table>
         <!-- Fin Tabla de pedidos -->

         <!-- Paginación -->
         <div class="col-sm-6 col-xs-12">
             {{ $pedidos->appends(['filtro' => $request->filtro])->links() }}
         </div>
         <!-- Fin Paginación -->

     </div>


 </div>
