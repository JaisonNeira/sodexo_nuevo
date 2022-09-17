<div class="modal fade" id="EditEmpleado{{ $list->emp_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="">
                <h6 class="modal-title">
                    Actualizar Información
                </h6>
            </div>

            @php
                use App\Models\empresa;
                use App\Models\sede;
            @endphp

            <form class="" method="POST" action="{{ route('empleado.update', $list->emp_id) }}" novalidate>
                @csrf
                @method('PUT')

                <div class="modal-body" id="cont_modal">
                    <div class="row">

                        <div class="col-md-6">
                            <label for="emp_cedula" class="form-label">Cedula</label>
                            <input type="number" class="form-control" id="emp_cedula" name="emp_cedula" required
                                pattern="[0-9]+" value="{{ $list->emp_cedula }}">
                            <div class="invalid-feedback">Completa los datos</div>
                        </div>
                        <div class="col-md-6">
                            <label for="emp_nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="emp_nombre" name="emp_nombre" required
                                onkeypress="return SoloLetras(event);" value="{{ $list->emp_nombre }}">
                            <div class="invalid-feedback">Completa los datos</div>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <label for="emp_apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="emp_apellidos" name="emp_apellidos"
                                required onkeypress="return SoloLetras(event);" value="{{ $list->emp_apellidos }}">
                            <div class="invalid-feedback">Completa los datos</div>
                            <br>
                        </div>

                        <div class="col-md-6">
                            <label for="empr_id" class="form-label">Empresa</label>
                            <select name="empr_id" id="empr_id" class="form-select"
                                aria-label="Default select example" required>
                                @php
                                    $data1 = empresa::where('empr_id', $list->empr_id)->get();
                                @endphp

                                @foreach ($data1 as $d1)
                                    <option value="{{ $d1->empr_id }}" selected>{{ $d1->empr_nombre }}</option>
                                @endforeach
                                <option value="" ></option>
                                @foreach ($empresas as $empr)
                                    <option value="{{ $empr->empr_id }}">{{ $empr->empr_nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="emp_cargo" class="form-label">Cargo</label>
                            <input type="text" class="form-control" id="emp_cargo" name="emp_cargo" required
                                onkeypress="return SoloLetras(event);" value="{{ $list->emp_cedula }}">
                            <div class="invalid-feedback">Completa los datos</div>
                            <br>
                        </div>

                        <div class="col-md-6">
                            <label for="sed_id" class="form-label">Sede</label>
                            <select name="sed_id" id="sed_id" class="form-select"
                                aria-label="Default select example" required>
                                @php
                                    $data2 = sede::where('sed_id', $list->sed_id)->get();
                                @endphp

                                @foreach ($data2 as $d2)
                                    <option value="{{ $d2->sed_id }}" selected>{{ $d2->sed_nombre }}</option>
                                @endforeach
                                <option value="" ></option>
                                @foreach ($sedes as $sed)
                                    <option value="{{ $sed->sed_id }}">{{ $sed->sed_nombre }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-secondary col-3"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success col-md-3">Guardar</button>
                        </div>
                    </div>
            </form>

        </div>
    </div>
</div>
