<!---msj de registro fallido -->
@error('enc_cedula')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong> {{$message}} </strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

@error('enc_nombre')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong> {{$message}} </strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

