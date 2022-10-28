<!-- Modal -->
<div class="modal fade" id="editar{{$medida->idmedida}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Editar unidad de medida: {{$medida->medida_nombre}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('actualizarmedida',$medida->idmedida)}}" method="POST">
                @csrf
                <label for="" class="form-label">Nombre</label>
                <input type="text" class="form-control" value="{{$medida->medida_nombre}}" id="nombre" name="nombre">
                <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>