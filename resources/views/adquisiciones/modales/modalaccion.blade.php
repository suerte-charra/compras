<!-- Modal -->
<div class="modal fade" id="accion{{$adquisicion->idadquisicion}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar una observación con folio: {{$adquisicion->folio}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{route('observacionadqui',$adquisicion->idadquisicion)}}" method="POST">
                            @csrf
                            <textarea name="observacion" id="observacion" cols="30" rows="10" class="form-control" required style="resize:none"></textarea>
                            <button type="submit" class="btn btn-primary mt-2">Agregar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>