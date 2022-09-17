@extends('layouts.main')

@section('title', 'Resultados')

@section('content')

    <div class="text-center">
        <h1>Evaluaciones Realizadas</h1>
        @include('layouts.msj')
        <div class="container" id="div_form">
            <form action="{{ route('export.calificaciones') }}" method="get" role="form" class="needs-validation"
                novalidate>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-6">
                        <label for="tbl_sedes_codigo" class="form-label">Fecha Inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                        <div class="invalid-feedback">
                            Seleccione una fecha inicial
                        </div>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label for="tbl_sedes_codigo" class="form-label">Fecha Fin</label>
                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                        <div class="invalid-feedback">
                            Seleccione una fecha final
                        </div>
                        <br>
                    </div>
                    <div class="col-md-12">
                        <input type="button" onclick="cargarDatos();" class="btn btn-primary" value="Cargar Resultados">
                        <button type="submit" class="btn btn-primary">Descargar Resultados</button>
                        <br><br>
                    </div>
                </div>
            </form>

            {{-- BUSQUEDA AVANZADA --}}
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#busqueda_avanzada"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class='bx bx-search' style="font-size: 20px; !Importand"></i>
                <span>Busqueda avanzada</span>
            </a>
            <div id="busqueda_avanzada" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="py-2 collapse-inner rounded" id="form_busqueda_avanzada">
                    <form class="needs-validation" novalidate>
                        <input type="text" class="form-control" id="ba_cal_id" name="cal_id" style="display: none;">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Cedula</label>
                                <input type="number" class="form-control" id="ba_emp_nombre" name="emp_cedula" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Curso</label>
                                <select id="ba_cur_id" name="cur_id" class="form-select" required>
                                    <option class="form-control" value="" selected disabled>-- Seleccione --</option>
                                    @foreach ($cursos as $cur)
                                        <Option value="{{ $cur->cur_id }}">{{ $cur->cur_nombre }}</Option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Encargado</label>
                                <select id="ba_enc_id" name="enc_id" class="form-select" required>
                                    <option class="form-control" value="" selected disabled>-- Seleccione --</option>
                                    @foreach ($encargados as $enc)
                                        <Option value="{{ $enc->enc_id }}">{{$enc->enc_cedula}} - {{ $enc->enc_nombre }}</Option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="button" onclick="busqueda_avanzada();" class="btn btn-primary" value="Buscar">
                    </form>
                </div>
            </div>

            {{-- AND BUSQUEDA AVANZADA --}}

        </div>
    </div>

    <div class="table-responsive">
        @include('tabla_resultados')
    </div>

    <!-- MODAL EDITAR -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Informacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('update.resultado') }}">
                        @csrf
                        @method('PUT')

                        <input type="text" class="form-control" id="cal_id" name="cal_id"
                            style="display: none;">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Codigo</label>
                                <input type="text" class="form-control" id="cal_codigo" name="cal_codigo" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Nombre</label>
                                <input type="text" class="form-control" id="emp_nombre" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Curso</label>
                                <select id="cur_id" name="cur_id" class="form-select">
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Encargado</label>
                                <select id="enc_id" name="enc_id" class="form-select">
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress">Fecha Creacion</label>
                                <input type="text" class="form-control" id="created_at" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress">Calificacion</label>
                                <input type="number" class="form-control" id="cal_calificacion"
                                    name="cal_calificacion">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="float: right;">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- AND MODAL EDITAR -->

    <!-- MODAL VER -->
    <div class="modal fade" id="verModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mas informacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Informacion Personal</h4>
                    <div>
                        <table class="table table-bordered">
                            <tbody name="info_empleado">

                            </tbody>
                        </table>
                    </div>
                    <h4>Informacion de la calificacion</h4>
                    <div>
                        <table class="table table-bordered">
                            <tbody name="info_calificacion">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- AND MODAL VER -->


    <script src="{{ asset('jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/ajax-resultados.js') }}"></script>
@endsection
