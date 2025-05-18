
        
<!-- Vertically centered Modal -->
<a type="button" class="text-danger" data-bs-toggle="modal" data-bs-target="#modalCuotas{{ $inscripcion->id }}">
    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Ver todas las cuotas">
        {{ date_format(date_create($inscripcion->proxima_fecha_pago), 'd/m/Y')  }} - ver mas...
    </span>
</a>
    


<div class="modal fade" id="modalCuotas{{ $inscripcion->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lista de cuotas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                        <tr class="">
                            <td colspan="3" class="">Estudiante: {{ $inscripcion->estudiante_nombre }} </td>
                           
                        </tr>
                        <tr class="bg-primary text-white">
                            <td>Fecha</td>
                            <td>Monto</td>
                            <td>Estatus</td>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($inscripcion->cuotas as $cuota)
                                <tr class="{{  $cuota->estatus ? "table-success" : "table-danger" }}">
                                    <td>{{ 
                                        date_format( date_create( $cuota->fecha ), 'd/m/Y' )
                                    }}</td>
                                    <td>{{ $cuota->cuota }}</td>
                                    <td>{{ $cuota->estatus ? "PAGADO" : "PENDIENTE" }}</td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        
        </div>
    </div>
</div><!-- End Vertically centered Modal-->




