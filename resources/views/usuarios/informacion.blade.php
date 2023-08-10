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
                            <h5 class="text-center mt-2">Usuario</h5>
                            <div class="row">
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" readonly placeholder="Nombre"
                                        value="{{ $usuario->name }}">
                                    <label for="name">Nombre</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" readonly placeholder="Email"
                                        value="{{ $usuario->email }}">
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control text-uppercase" placeholder="Email"
                                        value="{{ $usuario->categoria }}" readonly>
                                    <label for="email">Rol</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" placeholder="Email"
                                        value="{{ $usuario->dependencia_nombre ?? 'ES ADMINISTRADOR' }}" readonly>
                                    <label for="email">Dependencia</label>
                                </div>
                            </div>
                            <div>
                                <form action="{{route('userUpdate', $usuario->id)}}" method="POST" class="row">
                                    @csrf
                                    <h4>Actualización de datos</h4>
                                    <div class="row">
                                        <div class="form-floating mb-3 col-6">
                                            <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                                id="dependencia" name="dependencia">
                                                <option value="0" selected>Seleccione nueva dependencia</option>
                                                @foreach ($dependencias as $dependencia)
                                                    <option value="{{ $dependencia->iddependencia }}">
                                                        {{ $dependencia->dependencia_nombre }}</option>
                                                @endforeach
                                            </select>
                                            <label for="email">Nueva dependencia</label>
                                        </div>
                                        <div class="form-floating mb-3 col-6">
                                            <select class="form-select" name="categoria" id="categoria"
                                                aria-label="Default select example" required>
                                                <option value="0" selected>Seleccione nuevo rol</option>
                                                <option value="dir">Director</option>
                                                <option value="cap">Dependencia</option>
                                                <option value="lector">Lector</option>
                                                <option value="compras">Compras</option>
                                            </select>
                                            <label for="email">Categoria del rol</label>
                                        </div>
                                        <div class="form-check ms-3 mb-3 col-6">
                                            <input class="form-check-input" type="checkbox" id="restaurar" name="restaurar">
                                            <label class="form-check-label" for="restaurar">
                                                Restablecer contraseña
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-sm btn-success mb-3">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
