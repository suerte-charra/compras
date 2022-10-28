<!-- Modal -->
<div class="modal fade" id="editar{{$adquisicion->idadquisicion}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                        {{-- <select name="dependencia_1" id="dependencia_1" class="form-select @error('dependencia_1') is-invalid @enderror">
                            <option value="">Si desea cambiar seleccione una opción</option>
                            @foreach($dependencias as $dependencia)
                                @if($adquisicion->dependencia_nombre <> $dependencia->dependencia_nombre)
                                    <option value="{{$dependencia->iddependencia}}">{{$dependencia->dependencia_nombre}}</option>
                                @endif
                            @endforeach
                        </select> --}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-2 border">
                        <label for="" class="form-label">Documento presentado</label>
                        @if($adquisicion->documento)
                            <a href="{{asset('/documentos/documentospresentados/'.$adquisicion->documento)}}" target="_blank">{{$adquisicion->documento}}</a>
                        @else
                            No tiene documento
                        @endif
                        <input type="file" name="dpresentado_1" id="dpresentado_1" accept=".pdf" class="form-control @error('dpresentado_1') is-invalid @enderror">
                    </div>
                    <div class="col-md-6 mt-2 border">
                        <label for="" class="form-label">Investigación de mercado&nbsp;</label>
                        @if($adquisicion->investigacion)
                            <a href="{{asset('/documentos/investigaciondemercado/'.$adquisicion->investigacion)}}" target="_blank">{{$adquisicion->investigacion}}</a>
                        @else
                            No tiene investigación de mercado
                        @endif
                        <input type="file" name="imercado_1" id="imercado_1" accept=".pdf" class="form-control @error('imercado_1') is-invalid @enderror">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-2 border">
                        <label for="" class="form-label">Respuesta requisitoria</label>
                        @if($adquisicion->resrequi)
                            <a href="{{asset('/documentos/respuestarequisitoria/'.$adquisicion->resrequi)}}" target="_blank">{{$adquisicion->resrequi}}</a>
                        @else
                            No tiene respuesta requisitoria
                        @endif
                        <input type="file" name="rrequisitoria_1" id="rrequisitoria_1" accept=".pdf" class="form-control @error('rrequisitoria_1') is-invalid @enderror">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="" class="form-label">Partida presupuestal</label>
                        <input type="text" name="ppresupuestal_1" id="ppresupuestal_1" class="form-control @error('ppresupuestal_1') is-invalid @enderror" value="{{$adquisicion->partida}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mt-2 border">
                        <label for="" class="form-label">Clasificaciones</label>
                        <input type="text" name="nactual" id="nactual" class="form-control" value="{{$adquisicion->clasificacion_nombre}}" readonly>
                        <select name="clasificacion_1" id="clasificacion_1" class="form-select @error('clasificacion_1') is-invalid @enderror">
                            <option value="">Si desea cambiar seleccione una opción</option>
                            @foreach($clasificaciones as $clasificacion)
                                @if($adquisicion->clasificacion_nombre <> $clasificacion->clasificacion_nombre)
                                    <option value="{{$clasificacion->idclasificacion}}">{{$clasificacion->clasificacion_nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-2 border">
                        <label for="" class="form-label">Unidad de medida</label>
                        <input type="text" name="nactual" id="nactual" class="form-control" value="{{$adquisicion->medida_nombre}}" readonly>
                        <select name="umedida_1" id="umedida_1" class="form-select @error('umedida_1') is-invalid @enderror">
                            <option value="">Si desea cambiar seleccione una opción</option>
                            @foreach($medidas as $medida)
                                @if($adquisicion->medida_nombre <> $medida->medida_nombre)
                                    <option value="{{$medida->idmedida}}">{{$medida->medida_nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-2 border">
                        <label for="" class="form-label">Fuentes de financimaiento</label>
                        <input type="text" name="nactual" id="nactual" class="form-control" value="{{$adquisicion->financiamiento_nombre}}" readonly>
                        <select name="ffinanciamiento_1" id="ffinanciamiento_1" class="form-select @error('ffinanciamiento_1') is-invalid @enderror">
                            <option value="">Si desea cambiar seleccione una opción</option>
                            @foreach($financiamientos as $financiamiento)
                                @if($adquisicion->financiamiento_nombre <> $financiamiento->financiamiento_nombre)
                                    <option value="{{$financiamiento->idfinanciamiento}}">{{$financiamiento->financiamiento_nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 mt-2">
                        <label for="" class="form-lable">Monto $</label>
                        <input type="text" name="monto_1" id="monto_1" class="form-control @error('monto_1') is-invalid @enderror" value="{{$adquisicion->monto}}">
                    </div>
                    <div class="col-3 mt-2">
                        <label for="" class="form-lable">Proveedor</label>
                        <input type="text" name="proveedor_1" id="proveedor_1" class="form-control @error('proveedor_1') is-invalid @enderror" value="{{$adquisicion->proveedor}}">
                    </div>
                    <div class="col-3 mt-2">
                        <label for="" class="form-lable">Fecha de adquisición</label>
                        <input type="date" name="faprox_1" id="faprox_1" class="form-control @error('faprox_1') is-invalid @enderror" value="{{$adquisicion->fechaaprox}}">
                    </div>
                    <div class="col-3 mt-2">
                        <label for="" class="form-lable">Fecha de entrega</label>
                        <input type="date" name="fentrega_1" id="fentrega_1" class="form-control @error('fentrega_1') is-invalid @enderror" value="{{$adquisicion->fechaentrega}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 mt-2">
                        <label for="" class="form-lable">Descripción general de bienes</label>
                        <textarea name="dgeneral_1" id="dgeneral_1" cols="45" rows="5" class="form-control @error('dgeneral_1') is-invalid @enderror" style="resize: none;">{{$adquisicion->descripcion}}</textarea>
                    </div>
                    <div class="col-4 mt-2">
                        <label for="" class="form-lable">Descripción de la adquisición</label>
                        <textarea name="dadquisicion_1" id="dadquisicion_1" cols="45" rows="5" class="form-control @error('dadquisicion_1') is-invalid @enderror" style="resize: none;">{{$adquisicion->descripcionadqui}}</textarea>
                    </div>
                    <div class="col-4 mt-2">
                        <label for="" class="form-lable">Observaciones</label>
                        <textarea name="observaciones_1" id="observaciones_1" cols="45" rows="5" class="form-control @error('observaciones_1') is-invalid @enderror" style="resize: none;"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2 ">
                        <label for="" class="form-label">Estaus de adquisición</label>
                        <select name="estatus_adqui" id="estatus_adqui" class="form-select">
                            <option value="1">Seleccionar una opción...</option>
                            <option value="2">Aprobada</option>
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