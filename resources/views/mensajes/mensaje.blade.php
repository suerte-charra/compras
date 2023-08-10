@if (Auth::user()->user_passestatus == 0)
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Recuerde cambiar su contraseña</strong>
        <p>Este mensaje no desaparecera hasta que haya hecho el cambio de contraseña</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif 