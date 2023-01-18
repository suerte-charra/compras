
<!-- Modal -->
<div class="modal fade" id="editar{{$adquisicionesaprobada->idadquisicion}}" data-bs-backdrop="static" data-bs-keyboard="false"  aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Editar Adquisición: {{$adquisicionesaprobada->idadquisicion}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('actualizaradquisicion',$adquisicionesaprobada->idadquisicion)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label for="" class="form-label">Fecha de ingreso</label>
                        <input type="text" class="form-control @error('fingresio_1') is-invalid @enderror" value="{{$adquisicionesaprobada->fechaadqui}}" id="fingresio_1" name="fingresio_1" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Folio</label>
                        <input type="text" class="form-control @error('folio_1') is-invalid @enderror" value="{{$adquisicionesaprobada->folio}}" id="folio_1" name="folio_1" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Unidad presupuestaria responsable</label>
                        <input type="text" name="nactual" id="nactual" class="form-control" value="{{$adquisicionesaprobada->dependencia_nombre}}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-2 border">
                        <label for="" class="form-label">Documento presentado</label>
                        @if($adquisicionesaprobada->documento)
                            <a href="{{asset('/documentos/documentospresentados/'.$adquisicionesaprobada->documento)}}" target="_blank">{{$adquisicionesaprobada->documento}}</a>
                        @else
                            No tiene documento
                        @endif
                        <input type="file" name="dpresentado_1" id="dpresentado_1" accept=".pdf" class="form-control @error('dpresentado_1') is-invalid @enderror">
                    </div>
                    <div class="col-md-6 mt-2 border">
                        <label for="" class="form-label">Investigación de mercado&nbsp;</label>
                        @if($adquisicionesaprobada->investigacion)
                            <a href="{{asset('/documentos/investigaciondemercado/'.$adquisicionesaprobada->investigacion)}}" target="_blank">{{$adquisicionesaprobada->investigacion}}</a>
                        @else
                            No tiene investigación de mercado
                        @endif
                        <input type="file" name="imercado_1" id="imercado_1" accept=".pdf" class="form-control @error('imercado_1') is-invalid @enderror">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-2 border">
                        <label for="" class="form-label">Respuesta requisitoria</label>
                        @if($adquisicionesaprobada->resrequi)
                            <a href="{{asset('/documentos/respuestarequisitoria/'.$adquisicionesaprobada->resrequi)}}" target="_blank">{{$adquisicionesaprobada->resrequi}}</a>
                        @else
                            No tiene respuesta requisitoria
                        @endif
                        <input type="file" name="rrequisitoria_1" id="rrequisitoria_1" accept=".pdf" class="form-control @error('rrequisitoria_1') is-invalid @enderror">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="" class="form-label">Partida presupuestal</label>
                        <input type="text" name="ppresupuestal_1" id="ppresupuestal_1" class="form-control @error('ppresupuestal_1') is-invalid @enderror" value="{{$adquisicionesaprobada->partida}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mt-2 border">
                        <label for="" class="form-label">Clasificaciones</label>
                        <input type="text" name="nactual" id="nactual" class="form-control" value="{{$adquisicionesaprobada->clasificacion_nombre}}" readonly>
                        <select name="clasificacion_1" id="clasificacion_1" class="form-select @error('clasificacion_1') is-invalid @enderror">
                            <option value="">Si desea cambiar seleccione una opción</option>
                            @foreach($clasificaciones as $clasificacion)
                                @if($adquisicionesaprobada->clasificacion_nombre <> $clasificacion->clasificacion_nombre)
                                    <option value="{{$clasificacion->idclasificacion}}">{{$clasificacion->clasificacion_nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-2 border">
                        <label for="" class="form-label">Unidad de medida</label>
                        <input type="text" name="nactual" id="nactual" class="form-control" value="{{$adquisicionesaprobada->medida_nombre}}" readonly>
                        <select name="umedida_1" id="umedida_1" class="form-select @error('umedida_1') is-invalid @enderror">
                            <option value="">Si desea cambiar seleccione una opción</option>
                            @foreach($medidas as $medida)
                                @if($adquisicionesaprobada->medida_nombre <> $medida->medida_nombre)
                                    <option value="{{$medida->idmedida}}">{{$medida->medida_nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-2 border">
                        <label for="" class="form-label">Fuentes de financimaiento</label>
                        <input type="text" name="nactual" id="nactual" class="form-control" value="{{$adquisicionesaprobada->financiamiento_nombre}}" readonly>
                        <select name="ffinanciamiento_1" id="ffinanciamiento_1" class="form-select @error('ffinanciamiento_1') is-invalid @enderror">
                            <option value="">Si desea cambiar seleccione una opción</option>
                            @foreach($financiamientos as $financiamiento)
                                @if($adquisicionesaprobada->financiamiento_nombre <> $financiamiento->financiamiento_nombre)
                                    <option value="{{$financiamiento->idfinanciamiento}}">{{$financiamiento->financiamiento_nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9 mt-2">
                        <label for="" class="form-lable">Proveedores</label>
                        <input list="proveedores" id="proveedor_1" name="proveedor_1" class="form-control" value="{{$adquisicionesaprobada->nombre_comercial ?? ''}}">
                        <datalist id="proveedores">
                            @foreach ($proveedores as $proveedor)
                                <option value="{{$proveedor->idproveedor}}-{{$proveedor->nombre_comercial}}"></option>
                            @endforeach
                        </datalist>
                    </div>
                    <div class="col-3 mt-2">
                        <label for="" class="form-lable">Monto $</label>
                        <input type="text" name="monto_1" id="monto_1" class="form-control @error('monto_1') is-invalid @enderror" value="{{$adquisicionesaprobada->monto}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mt-2">
                        <label for="" class="form-lable">Fecha de adquisición</label>
                        <input type="date" name="faprox_1" id="faprox_1" class="form-control @error('faprox_1') is-invalid @enderror" value="{{$adquisicionesaprobada->fechaaprox}}">
                    </div>
                    <div class="col-6 mt-2">
                        <label for="" class="form-lable">Fecha de entrega</label>
                        <input type="date" name="fentrega_1" id="fentrega_1" class="form-control @error('fentrega_1') is-invalid @enderror" value="{{$adquisicionesaprobada->fechaentrega}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 mt-2">
                        <label for="" class="form-lable">Descripción general de bienes</label>
                        <textarea name="dgeneral_1" id="dgeneral_1" cols="45" rows="5" class="form-control @error('dgeneral_1') is-invalid @enderror" style="resize: none;">{{$adquisicionesaprobada->descripcion}}</textarea>
                    </div>
                    <div class="col-4 mt-2">
                        <label for="" class="form-lable">Descripción de la adquisición</label>
                        <textarea name="dadquisicion_1" id="dadquisicion_1" cols="45" rows="5" class="form-control @error('dadquisicion_1') is-invalid @enderror" style="resize: none;">{{$adquisicionesaprobada->descripcionadqui}}</textarea>
                    </div>
                    <div class="col-4 mt-2">
                        <label for="" class="form-lable">Observaciones</label>
                        <textarea name="observaciones_1" id="observaciones_1" cols="45" rows="5" class="form-control @error('observaciones_1') is-invalid @enderror" style="resize: none;" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2 ">
                        <label for="" class="form-label">Estaus de adquisición</label>
                        <select name="estatus_adqui" id="estatus_adqui" class="form-select">
                            <option value="2">Seleccionar una opción...</option>
                            <option value="0">No aprobada</option>
                            <option value="4">En almacén</option>
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
  