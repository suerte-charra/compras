@extends('layouts.principal')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">
    <style>
        .toast-success {
            background-color: #51a351 !important;
        }

        .toast-error {
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
                        <h4>Buscar requisición</h4>
                    </div>

                    <div class="m-2">
                        <form action="{{route('buscarFolio')}}" method="POST">
                            @csrf
                            <label for="bfolio">Buscar folio<b style="color: red">*</b>: </label>
                            <input type="text" class="form-control" placeholder="Ejemplo: XXXXX-23" style="width: 160px"
                                id="bfolio" name="bfolio" required>
                            <button type="submit" class="btn btn-sm btn-success mt-2">Buscar</button>
                        </form>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
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
        @endsection
    </div>
@endsection
