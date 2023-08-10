<!-- Modal -->
<div class="modal fade" id="editar{{ $adqui->idadquisicion }}" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Adquisición: {{ $adqui->idadquisicion }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('actualizarFolio', $adqui->idadquisicion) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="form-label">Fecha de ingreso</label>
                            <input type="text" class="form-control @error('fingresio_1') is-invalid @enderror"
                                value="{{ $adqui->fechaadqui }}" id="fingresio_1" name="fingresio_1" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Folio</label>
                            <input type="text" class="form-control @error('folio_1') is-invalid @enderror"
                                value="{{ $adqui->folio }}" id="folio_1" name="folio_1" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Unidad presupuestaria responsable</label>
                            <input type="text" name="nactual" id="nactual" class="form-control"
                                value="{{ $adqui->dependencia_nombre }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for="" class="form-label">Partida presupuestal</label>
                            <input type="text" name="ppresupuestal_1" id="ppresupuestal_1"
                                class="form-control @error('ppresupuestal_1') is-invalid @enderror"
                                value="{{ $adqui->partida }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-2">
                            <label for="" class="form-lable">Proveedores</label>
                            <input list="proveedores" id="proveedor_1" name="proveedor_1" class="form-control"
                                @if ($adqui->idproveedor && $adqui->nombre_comercial) value="{{ $adqui->idproveedor . '-' . $adqui->nombre_comercial ?? '' }}"
                                @else
                                    value="" @endif>
                            <datalist id="proveedores">
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->idproveedor }}-{{ $proveedor->nombre_comercial }}">
                                    </option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-3 mt-2">
                            <label for="" class="form-lable">Monto $</label>
                            <input type="text" name="monto_1" id="monto_1"
                                class="form-control @error('monto_1') is-invalid @enderror"
                                value="{{ $adqui->monto }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-2">
                            <label for="" class="form-lable">Fecha de adjudicación</label>
                            <input type="date" name="faprox_1" id="faprox_1"
                                class="form-control @error('faprox_1') is-invalid @enderror"
                                value="{{ $adqui->fechaaprox }}">
                        </div>
                        <div class="col-6 mt-2">
                            <label for="" class="form-lable">Fecha de entrega</label>
                            <input type="date" name="fentrega_1" id="fentrega_1"
                                class="form-control @error('fentrega_1') is-invalid @enderror"
                                value="{{ $adqui->fechaentrega }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 mt-2">
                            <label for="" class="form-lable">Descripción general de bienes</label>
                            <textarea name="dgeneral_1" id="dgeneral_1" cols="45" rows="5"
                                class="form-control @error('dgeneral_1') is-invalid @enderror" style="resize: none;">{{ $adqui->descripcion }}</textarea>
                        </div>
                        <div class="col-4 mt-2">
                            <label for="" class="form-lable">Descripción de la adquisición</label>
                            <textarea name="dadquisicion_1" id="dadquisicion_1" cols="45" rows="5"
                                class="form-control @error('dadquisicion_1') is-invalid @enderror" style="resize: none;">{{ $adqui->descripcionadqui }}</textarea>
                        </div>
                        <div class="col-4 mt-2">
                            <label for="" class="form-lable">Observaciones<b
                                    class="text-danger">*</b></label>
                            <textarea name="observaciones_1" id="observaciones_1" cols="45" rows="5"
                                class="form-control @error('observaciones_1') is-invalid @enderror" style="resize: none;" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-2 ">
                            <label for="" class="form-label">Estaus de adquisición</label>
                            <select name="estatus_adqui" id="estatus_adqui" class="form-select">
                                <option value="10">Seleccionar una opción...</option>
                                @if ($adqui->adquisicion_estatus == 1)
                                    <option value="2">Aceptada</option>
                                @elseif($adqui->adquisicion_estatus == 2)
                                    <option value="3">Autorizada</option>
                                @elseif($adqui->adquisicion_estatus == 3)
                                    <option value="4">Adjudicada</option>
                                @elseif($adqui->adquisicion_estatus == 4)
                                    <option value="5">En almacen</option>
                                @elseif($adqui->adquisicion_estatus == 5)
                                    <option value="6">Entregada</option>
                                @endif
                                <option value="0">No aprobada</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Actualizar datos</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
