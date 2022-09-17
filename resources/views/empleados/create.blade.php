<div class="modal fade" id="CrearEmpleados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                {{-- formulario --}}
                <form action="{{ route('empleado.create') }}" method="POST" name="form-data"
                    class="row needs-validation" novalidate>
                    @csrf
                    <div class="col-md-6">
                        <label for="emp_cedula" class="form-label">Cedula</label>
                        <input type="number" class="form-control" id="emp_cedula" name="emp_cedula" required
                            pattern="[0-9]+">
                        <div class="invalid-feedback">Completa los datos</div>
                    </div>
                    <div class="col-md-6">
                        <label for="emp_nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="emp_nombre" name="emp_nombre" required
                            onkeypress="return SoloLetras(event);">
                        <div class="invalid-feedback">Completa los datos</div>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label for="emp_apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="emp_apellidos" name="emp_apellidos" required
                            onkeypress="return SoloLetras(event);">
                        <div class="invalid-feedback">Completa los datos</div>
                        <br>
                    </div>

                    <div class="col-md-6">
                        <label for="empr_id" class="form-label">Empresa</label>
                        <select name="empr_id" id="empr_id"
                            class="form-select" aria-label="Default select example" required>
                            <option value=""></option>
                            @foreach ($empresas as $empr)
                                <option value="{{ $empr->empr_id }}">{{ $empr->empr_nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="emp_cargo" class="form-label">Cargo</label>
                        <input type="text" class="form-control" id="emp_cargo" name="emp_cargo" required
                            onkeypress="return SoloLetras(event);">
                        <div class="invalid-feedback">Completa los datos</div>
                        <br>
                    </div>

                    <div class="col-md-6">
                        <label for="sed_id" class="form-label">Sede</label>
                        <select name="sed_id" id="sed_id"
                            class="form-select" aria-label="Default select example" required>
                            <option value=""></option>
                            @foreach ($sedes as $sed)
                                <option value="{{ $sed->sed_id }}">{{ $sed->sed_nombre }}</option>
                            @endforeach
                        </select>
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
