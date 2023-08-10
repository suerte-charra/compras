@extends('layouts.principal')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">

    <style>
        .toast-success{
            background-color: #51a351 !important;
        }
        .toast-error{
            background-color: #be5252 !important;
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Lista de adquisiciones almacen</h4>
                    @if (Auth::user()->categoria == 'cap')
                        <div class="row">
                            <div class="col align-self-end text-end">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#agregar">Agregar Adquision</button>
                            </div>
                        </div>
                    @endif
                    
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container border">
                        <h5 class="text-center mt-2">Adquisiciones adjudicadas al proveedor</h5>
                        <table id="example" class="table table-striped dt-responsive nowrap border" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Fecha Ingreso</th>
                                    <th>Folio</th>
                                    <th>Dependencia</th>
                                    <th>Contenido</th>
                                    <th>Observaciones</th>
                                    <th>Documentación</th>
                                    <th>Estatus</th>
                                    <th>Partida Presupuestal</th>
                                    <th>Descripción General</th>
                                    <th>Clasificación</th>
                                    <th>Unidad de Medida</th>
                                    <th>Desc. Adquisición</th>
                                    <th>Fuentes de Financiamiento</th>
                                    <th>Monto</th>
                                    <th>Proveedor</th>
                                    <th>Fecha de Adjudicación</th>
                                    <th>Fecha Entrega</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($adquisiciones as $adquisicion)
                                <tr 
                                @if (Auth::user()->categoria <> 'admin' && Auth::user()->categoria <> 'cap')
                                    @if ($adquisicion->adquisicion_estatus == 2)
                                        style = "color:black;background:#7BCB62;"
                                    @elseif ($adquisicion->adquisicion_estatus == 1)
                                        style = "color:black;background:#FFFFFF;"
                                    @elseif ($adquisicion->adquisicion_estatus == 0)
                                        style = "color:black;background:#CB6262;"
                                    @endif  
                                @endif
                                >
                                    <td>{{$adquisicion->fechaadqui}}</td>
                                    <td>{{$adquisicion->folio}}</td>
                                    <td>{{$adquisicion->dependencia_nombre}}</td>
                                    <td>
                                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#contenido{{$adquisicion->idadquisicion}}"><i class="fa-regular fa-folder-closed"></i> Contenido</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#observaciones{{$adquisicion->idadquisicion}}"><i class="fa-regular fa-eye"></i> Observaciones</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#documentacion{{$adquisicion->idadquisicion}}"><i class="fa-regular fa-file"></i> Documentos</button>
                                    </td>
                                    <td>
                                        @if ($adquisicion->adquisicion_estatus == 4)
                                            A LA ESPERA DEL PROVEEDOR
                                        @elseif($adquisicion->adquisicion_estatus == 5)
                                            EN EL ALMANCEN
                                        @elseif($adquisicion->adquisicion_estatus == 6)
                                            ENTREGADO
                                        @else
                                            ERROR
                                        @endif
                                    </td>
                                    <td>{{$adquisicion->partida ?? 'No se agrego partida presupuestal'}}</td>
                                    <td>{{$adquisicion->descripcion}}</td>
                                    <td>{{$adquisicion->clasificacion_nombre}}</td>
                                    <td>{{$adquisicion->medida_nombre}}</td>
                                    <td>{{$adquisicion->descripcionadqui}}</td>
                                    <td>{{$adquisicion->financiamiento_nombre}}</td>
                                    <td>${{number_format($adquisicion->monto,2, '.', ',')}}</td>
                                    <td>{{$adquisicion->nombre_comercial ?? 'No hay proveedor'}}</td>
                                    <td>{{$adquisicion->fechaaprox}}</td>
                                    <td>{{$adquisicion->fechaentrega}}</td>
                                    <td>
                                        @if ($adquisicion->adquisicion_estatus == 4)
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editar{{$adquisicion->idadquisicion}}">Editar</button>    
                                        @else
                                            NO ACCIONES QUE REALIZAR
                                        @endif
                                        
                                    </td>
                                </tr>
                                @include('adquisiciones.modales.modaleditaralmacen')
                                @include('adquisiciones.modales.modalobservaciones')
                                @include('adquisiciones.modales.modaldocumentacion')
                                @include('adquisiciones.modales.modalcontenido')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 8000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif
        });
    </script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                scrollX: true,
                "lengthMenu": [[15,20,50,-1],[15,20,50,"Todos"]],
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Registros",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
            });
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script> --}}
@endsection
<!-- Modal -->
    <div class="modal fade" id="agregar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Agregar adquisición</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="{{route('agregaradquisicion')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-3">
                        <label for="" class="form-lable">Fecha de ingreso</label>
                        <input type="text" name="fingreso" id="fingreso" class="form-control @error('fingreso') is-invalid @enderror" value="{{$fecha}}" readonly>
                    </div>
                    <div class="col-3">
                        <label for="" class="form-lable">Folio</label>
                        <input type="text" name="folio" id="folio" minlength="5" maxlength="5" pattern="[0-9]{5,5}" class="form-control @error('folio') is-invalid @enderror" value="{{ old('folio') }}" required>
                    </div>
                    <div class="col-6"> 
                        <label for="" class="form-lable">Unidad presupuestaria responsable</label>
                        <select name="dependencia" id="dependencia" class="form-select @error('dependencia') is-invalid @enderror" required>
                            <option value="" selected>Seleccionar presupuestaria responsable...</option>
                            @foreach($dependencias as $dependencia)
                                <option value="{{$dependencia->iddependencia}}">{{$dependencia->dependencia_nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mt-2">
                        <label for="" class="form-lable">Documento presentado</label>
                        <input type="file" name="dpresentado" id="dpresentado" accept=".pdf" class="form-control @error('dpresentado') is-invalid @enderror">
                        @error('dpresentado')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-6 mt-2">
                        <label for="" class="form-lable">Investigación de mercado</label>
                        <input type="file" name="imercado" id="imercado" accept=".pdf" class="form-control @error('imercado') is-invalid @enderror">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mt-2">
                        <label for="" class="form-lable">Respuesta requisitoria</label>
                        <input type="file" name="rrequisitoria" id="rrequisitoria" accept=".pdf" class="form-control @error('rrequisitoria') is-invalid @enderror">
                    </div>
                    <div class="col-6 mt-2">
                        <label for="" class="form-lable">Partida presupuestal</label>
                        <input type="text" name="ppresupuestal" id="ppresupuestal" class="form-control @error('ppresupuestal') is-invalid @enderror">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 mt-2">
                        <label for="" class="form-lable">Clasificaciones</label>
                        <select name="clasificacion" id="clasificacion" class="form-select @error('clasificacion') is-invalid @enderror">
                            <option value="" selected>Seleccionar clasificacion...</option>
                            @foreach($clasificaciones as $clasificacion)
                                <option value="{{$clasificacion->idclasificacion}}">{{$clasificacion->clasificacion_nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4 mt-2">
                        <label for="" class="form-lable">Unidad de medida</label>
                        <select name="umedida" id="umedida" class="form-select @error('umedida') is-invalid @enderror">
                            <option value="" selected>Seleccionar unidad de medida...</option>
                            @foreach($medidas as $medida)
                                <option value="{{$medida->idmedida}}">{{$medida->medida_nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4 mt-2">
                        <label for="" class="form-lable">Fuentes de financiamiento</label>
                        <select name="ffinanciamiento" id="ffinanciamiento" class="form-select @error('ffinanciamiento') is-invalid @enderror">
                            <option value="" selected>Seleccionar fuente de financiamiento...</option>
                            @foreach($financiamientos as $financiamiento)
                                <option value="{{$financiamiento->idfinanciamiento}}">{{$financiamiento->financiamiento_nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 mt-2">
                        <label for="" class="form-lable">Monto $</label>
                        <input type="number" name="monto" id="monto" class="form-control @error('monto') is-invalid @enderror" step="0.01">
                    </div>
                    <div class="col-3 mt-2">
                        <label for="" class="form-lable">Proveedor</label>
                        <input type="text" name="proveedor" id="proveedor" class="form-control @error('proveedor') is-invalid @enderror">
                    </div>
                    <div class="col-3 mt-2">
                        <label for="" class="form-lable">Fecha de adjudicación</label>
                        <input type="date" name="faprox" id="faprox" class="form-control @error('faprox') is-invalid @enderror">
                    </div>
                    <div class="col-3 mt-2">
                        <label for="" class="form-lable">Fecha de entrega</label>
                        <input type="date" name="fentrega" id="fentrega" class="form-control @error('fentrega') is-invalid @enderror">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 mt-2">
                        <label for="" class="form-lable">Descripción general de bienes</label>
                        <textarea name="dgeneral" id="dgeneral" cols="45" rows="5" class="form-control @error('dgeneral') is-invalid @enderror" style="resize: none;"></textarea>
                    </div>
                    <div class="col-4 mt-2">
                        <label for="" class="form-lable">Descripción de la adquisición</label>
                        <textarea name="dadquisicion" id="dadquisicion" cols="45" rows="5" class="form-control @error('dadquisicion') is-invalid @enderror" style="resize: none;"></textarea>
                    </div>
                    <div class="col-4 mt-2">
                        <label for="" class="form-lable">Observaciones</label>
                        <textarea name="observaciones" id="observaciones" cols="45" rows="5" class="form-control @error('observaciones') is-invalid @enderror" style="resize: none;"></textarea>
                    </div>
                </div>
                {{-- <label for="" class="form-label">Nombre Clasificación</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre">
                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror --}}
                <button type="submit" class="btn btn-primary mt-2" onclick="return confirm('¿Desea guardar esta nueva adquisición?')">Guardar</button>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection