<!---msj de registro fallido -->
@error('emp_cedula')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong> {{$message}} </strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

@error('emp_nombre')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong> {{$message}} </strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

@error('emp_apellidos')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong> {{$message}} </strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

@error('empr_id')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong> {{$message}} </strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

@error('emp_cargo')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong> {{$message}} </strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

@error('sed_id')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong> {{$message}} </strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror
