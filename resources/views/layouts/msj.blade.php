<div class="col-lg-12">
    <!---msj de registrado correctamente -->
@if(Session::has('rgcmessage'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong> {{ Session::get('rgcmessage') }} </strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!--msj de registro eliminado correctamente --->
@if(Session::has('msjdelete'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong> {{ Session::get('msjdelete') }} </strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!--msj de registro eliminado fallido --->
@if(Session::has('dlfmessage'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong> {{ Session::get('dlfmessage') }} </strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


<!---msjs de actualizar registro correctamente-->
@if(Session::has('msjupdate'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong> {{ Session::get('msjupdate') }} </strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!--msj de registro eliminado fallido --->
@if(Session::has('noregistromessage'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong> {{ Session::get('noregistromessage') }} </strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

</div>
