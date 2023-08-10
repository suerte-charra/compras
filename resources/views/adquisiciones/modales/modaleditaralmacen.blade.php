
<!-- Modal -->
<div class="modal fade" id="editar{{$adquisicion->idadquisicion}}" data-bs-backdrop="static" data-bs-keyboard="false"  aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Editar Adquisición: {{$adquisicion->idadquisicion}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('actualizaradquisicion',$adquisicion->idadquisicion)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label for="" class="form-label">Fecha de ingreso</label>
                        <input type="text" class="form-control @error('fingresio_1') is-invalid @enderror" value="{{$adquisicion->fechaadqui}}" id="fingresio_1" name="fingresio_1" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Folio</label>
                        <input type="text" class="form-control @error('folio_1') is-invalid @enderror" value="{{$adquisicion->folio}}" id="folio_1" name="folio_1" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Unidad presupuestaria responsable</label>
                        <input type="text" name="nactual" id="nactual" class="form-control" value="{{$adquisicion->dependencia_nombre}}" readonly>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mt-2 border">
                        <label for="" class="form-label">Documento presentado</label>
                        @if($adquisicion->documento)
                            <a href="{{asset('/documentos/documentospresentados/'.$adquisicion->documento)}}" target="_blank">{{$adquisicion->documento}}</a>
                        @else
                            No tiene documento
                        @endif
                    </div>
                    <div class="col-md-4 mt-2 border">
                        <label for="" class="form-label">Investigación de mercado&nbsp;</label>
                        @if($adquisicion->investigacion)
                            <a href="{{asset('/documentos/investigaciondemercado/'.$adquisicion->investigacion)}}" target="_blank">{{$adquisicion->investigacion}}</a>
                        @else
                            No tiene investigación de mercado
                        @endif
                    </div>
                    <div class="col-md-4 mt-2 border">
                        <label for="" class="form-label">Respuesta requisitoria</label>
                        @if($adquisicion->resrequi)
                            <a href="{{asset('/documentos/respuestarequisitoria/'.$adquisicion->resrequi)}}" target="_blank">{{$adquisicion->resrequi}}</a>
                        @else
                            No tiene respuesta requisitoria
                        @endif
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-md-12 mt-2">
                        <label for="" class="form-label">Partida presupuestal</label>
                        <input type="text" name="ppresupuestal_1" id="ppresupuestal_1" class="form-control @error('ppresupuestal_1') is-invalid @enderror" value="{{$adquisicion->partida}}" readonly>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-4 mt-2 border">
                        <label for="" class="form-label">Clasificaciones</label>
                        <input type="text" name="nactual" id="nactual" class="form-control" value="{{$adquisicion->clasificacion_nombre}}" readonly>
                    </div>
                    <div class="col-md-4 mt-2 border">
                        <label for="" class="form-label">Unidad de medida</label>
                        <input type="text" name="nactual" id="nactual" class="form-control" value="{{$adquisicion->medida_nombre}}" readonly>
                        
                    </div>
                    <div class="col-md-4 mt-2 border">
                        <label for="" class="form-label">Fuentes de financimaiento</label>
                        <input type="text" name="nactual" id="nactual" class="form-control" value="{{$adquisicion->financiamiento_nombre}}" readonly>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-9 mt-2">
                        <label for="" class="form-lable">Proveedores</label>
                        <input list="proveedores" id="proveedor_1" name="proveedor_1" class="form-control" value="{{$adquisicion->idproveedor.'-'.$adquisicion->nombre_comercial ?? ''}}" readonly>                        
                    </div>
                    <div class="col-3 mt-2">
                        <label for="" class="form-lable">Monto $</label>
                        <input type="text" name="monto_1" id="monto_1" class="form-control  @error('monto_1') is-invalid @enderror" value="{{$adquisicion->monto}}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mt-2">
                        <label for="" class="form-lable">Fecha de adjudicación</label>
                        <input type="date" name="faprox_1" id="faprox_1" class="form-control @error('faprox_1') is-invalid @enderror" value="{{$adquisicion->fechaaprox}}" readonly>
                    </div>
                    <div class="col-6 mt-2">
                        <label for="" class="form-lable">Fecha de entrega</label>
                        <input type="date" name="fentrega_1" id="fentrega_1" class="form-control @error('fentrega_1') is-invalid @enderror" value="{{$adquisicion->fechaentrega}}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 mt-2">
                        <label for="" class="form-lable">Descripción general de bienes</label>
                        <textarea readonly name="dgeneral_1" id="dgeneral_1" cols="45" rows="5" class="form-control @error('dgeneral_1') is-invalid @enderror" style="resize: none;">{{$adquisicion->descripcion}}</textarea>
                    </div>
                    <div class="col-4 mt-2">
                        <label for="" class="form-lable">Descripción de la adquisición</label>
                        <textarea readonly name="dadquisicion_1" id="dadquisicion_1" cols="45" rows="5" class="form-control @error('dadquisicion_1') is-invalid @enderror" style="resize: none;">{{$adquisicion->descripcionadqui}}</textarea>
                    </div>
                    <div class="col-4 mt-2">
                        <label for="" class="form-lable">Observaciones<b class="text-danger">*</b></label>
                        <textarea name="observaciones_1" id="observaciones_1" cols="45" rows="5" class="form-control @error('observaciones_1') is-invalid @enderror" style="resize: none;" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2 ">
                        @if (Auth::user()->categoria == 'almacen')
                        <label for="" class="form-label">Estatus de adquisición</label>
                            @if ($tipo == 4)
                                <select name="estatus_adqui" id="estatus_adqui" class="form-select">
                                    <option value="4">Seleccionar una opción...</option>
                                    <option value="5">Surtido por el proveedor</option>
                                </select>
                            @elseif($tipo == 5)
                                <select name="estatus_adqui" id="estatus_adqui" class="form-select">
                                    <option value="5">Seleccionar una opción...</option>
                                    <option value="6">Entregado</option>
                                </select>
                            @elseif($tipo == 6)
                                
                            @endif
                        @else
                            <label for=""><p>No tiene la categoria para editar este tipo de requisición</p></label>
                        @endif
                        
                    </div>
                </div>
                @if (Auth::user()->categoria == 'almacen' && $tipo != 6)
                    <button type="submit" class="btn btn-primary mt-2">Actualizar datos</button>
                @endif
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>