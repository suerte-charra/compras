@extends('layouts.principal')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">
    <style>
        .toast-success {
            background-color: #51a351 !important;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lista de usuarios del sistema</h4>
                        <div class="row">
                            <div class="col align-self-end text-end">
                                <button class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#agregarusuario">Agregar usuario</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <label>{{ $error }}</label>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="container border">
                            <h5 class="text-center mt-2">Usuarios activos</h5>
                            <table id="example" class="table table-striped dt-responsive nowrap border"
                                style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Clave</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Dependencia</th>
                                        <th>Categoria</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->id }}</td>
                                            <td class="text-uppercase">{{ $usuario->name }}</td>
                                            <td class="text-uppercase">{{ $usuario->email }}</td>
                                            <td class="text-uppercase">
                                                {{ $usuario->dependencia_nombre ?? 'Usuario administrador' }}</td>
                                            <td class="text-uppercase">
                                                @if ($usuario->categoria == 'admin')
                                                    Administrador
                                                @elseif($usuario->categoria == 'cap')
                                                    Capturista
                                                @elseif($usuario->categoria == 'lector')
                                                    Lector
                                                @elseif($usuario->categoria == 'dir')
                                                    Director
                                                @elseif($usuario->categoria == 'lector')
                                                    Lector
                                                @elseif($usuario->categoria == 'compras')
                                                    Usuario de compras
                                                @else
                                                    {{ $usuario->categoria }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('bajausuario', $usuario->id) }}"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm ('¿Estás seguro de dar de baja este usuario?')">Desactivar</a>
                                                <a href="{{route('restablecePass', $usuario->id)}}" class="btn btn-sm btn-warning">Contraseña</a>
                                            </td>
                                        </tr>
                                        {{-- @include('clasificaciones.modales.modaleditar') --}}
                                    @endforeach
                                </tbody>
                            </table>
                        </div><br>
                        <div class="container border">
                            <h5 class="text-center mt-2">Usuarios inactivos</h5>
                            <table id="example_1" class="table table-striped dt-responsive nowrap border"
                                style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Clave</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Categoria</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios_1 as $usuario_1)
                                        <tr>
                                            <td>{{ $usuario_1->id }}</td>
                                            <td>{{ $usuario_1->name }}</td>
                                            <td>{{ $usuario_1->email }}</td>
                                            <td>
                                                @if ($usuario->categoria == 'admin')
                                                    Administrador
                                                @elseif($usuario->categoria == 'cap')
                                                    Capturista
                                                @elseif($usuario->categoria == 'lector')
                                                    Lector
                                                @elseif($usuario->categoria == 'dir')
                                                    Director
                                                @elseif($usuario->categoria == 'lector')
                                                    Lector
                                                @elseif($usuario->categoria == 'compras')
                                                    Usuario de compras
                                                @else
                                                    {{ $usuario->categoria }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('bajausuario', $usuario_1->id) }}"
                                                    class="btn btn-success btn-sm"
                                                    onclick="return confirm ('¿Estás seguro de activar este usuario?')">Activar</a>
                                            </td>
                                        </tr>
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
                @elseif (Session::has('success'))
                    toastr.success('{{ Session::get('success') }}');
                @endif
            });
        </script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable({
                    scrollX: true,
                    "lengthMenu": [
                        [15, 20, 50, -1],
                        [15, 20, 50, "Todos"]
                    ],
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
        <script>
            $(document).ready(function() {
                $('#example_1').DataTable({
                    scrollX: true,
                    "lengthMenu": [
                        [15, 20, 50, -1],
                        [15, 20, 50, "Todos"]
                    ],
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
        <script>
            $('#categoria').change(function() {
                categoria = document.getElementById('categoria').value;
                if (categoria == 'dir' || categoria == 'cap') {
                    $('#dependencia').removeAttr('disabled');
                } else {
                    $('#dependencia').attr('disabled', 'disabled');
                }

            })
        </script>
    @endsection
    <!-- Modal -->
    <div class="modal fade" id="agregarusuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Agregar usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('agregarusuario') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                    name="nombre" id="nombre" value="{{ old('nombre') }}" required autofocus>
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="exampleInputEmail1" class="form-label">Correo</label>
                                <input type="email" class="form-control @error('correo') is-invalid @enderror"
                                    name="correo" id="correo" value="{{ old('correo') }}" required>
                                @error('correo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div><br>
                        <div class="col-md-12 text-center border border-dark">
                            <p class="text-primary-emphasis text-body-emphasis">Si selecciona <b>lector</b> o
                                <b>compras</b> no es necesario elegir una dependencia</p>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleInputEmail1" class="form-label">Categoria</label>
                                <select class="form-select" name="categoria" id="categoria"
                                    aria-label="Default select example" required>
                                    <option value="">Seleccionar una opción...</option>
                                    <option value="dir">Director</option>
                                    <option value="cap">Dependencia</option>
                                    <option value="lector">Lector</option>
                                    <option value="compras">Compras</option>
                                </select>
                                @error('categoria')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-8">
                                <label for="exampleInputEmail1" class="form-label">Dependencia</label>
                                <select class="form-select" name="dependencia" id="dependencia"
                                    aria-label="Default select example" disabled>
                                    <option value="">Seleccionar una opción...</option>
                                    @foreach ($dependencias as $dependencia)
                                        <option value="{{ $dependencia->iddependencia }}">
                                            {{ $dependencia->dependencia_nombre }}</option>
                                    @endforeach
                                </select>
                                @error('dependencia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div><br>
                        <button type="submit" class="btn btn-primary">Registrar</button>
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
