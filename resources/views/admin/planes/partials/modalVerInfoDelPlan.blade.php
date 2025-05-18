
        
<!-- Vertically centered Modal -->
<a type="button" class="text-info" data-bs-toggle="modal" data-bs-target="#modalVerMasInfo{{$plane->id}}">
    <i class="bi bi-eye"
    data-bs-toggle="tooltip" data-bs-placement="top" title="Ver más información del plan"></i>
</a>

<div class="modal fade" id="modalVerMasInfo{{$plane->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Información del plan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="d-inline-flex p-2 bd-highlight ">
                <div class="w-25">
                    <img src="{{ asset('/src/images/planes_pago.png') }}"
                        class="img-thumbnail" />
                </div>
                <div class="m-2">
                    <p class="fs-3">{{ $plane->nombre }}</p>
                    <div class="">
                        <p>
                            <strong class="text-primary">Código:</strong>
                            {{ $plane->codigo }}    
                        </p>  
                        <p>
                            <strong class="text-primary">Descuento:</strong>
                            {{ $plane->porcentaje_descuento }} %
                        </p>  
                        <p>
                            <strong class="text-primary">Cantidad de cuotas:</strong>
                            {{ $plane->cantidad_cuotas }} 
                        </p>  
                        <p>
                            <strong class="text-primary">Plazo de días:</strong>
                            {{ $plane->plazo }} 
                        </p>  
                        <p>
                            <strong class="text-primary">Cantidad de estudiantes a inscribir con el plan:</strong>
                            {{ $plane->cantidad_estudiantes }} 
                        </p>  
                        <p>
                            <strong class="text-primary">Descripción:</strong>
                            {{ $plane->descripcion }} 
                        </p>  
                       
                    </div>
                  


                </div>
            </div>
        </div>
        <div class="modal-footer">
          
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div><!-- End Vertically centered Modal-->


