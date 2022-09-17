<div class="modal fade" id="CrearSede" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Sede</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                {{-- formulario --}}
                <form action="{{ route('sede.create') }}" method="POST" name="form-data"
                    class="row needs-validation" novalidate>
                    @csrf
                    <div class="col-md-12">
                        <label for="sed_nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="sed_nombre" name="sed_nombre" required
                            onkeypress="return SoloLetras(event);">
                        <div class="invalid-feedback">Completa los datos</div>
                        <br>
                    </div>

                    {{-- botones --}}
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-success col-3">Guardar</button>

                    </div>
                    {{-- fin botones --}}


                </form>
                {{-- fin formulario --}}


            </div>
        </div>
    </div>
</div>
