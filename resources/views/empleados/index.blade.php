@extends('layouts.main')

@section('title')
    Empleados
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Empleados</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <a>Cantidad: {{ $total }} </a>
                    <form class="d-flex">
                        <button type="button" class="btn btn-primary rounded-pill m-2" rel="tooltip" data-bs-toggle="modal"
                            data-bs-target="#CrearEmpleados">
                            <i class="fas fa-plus"></i>
                        </button>
                    </form>
                </div>
            </div>

            @include('empleados.create')

            @include('layouts.msj')

            <div class="card mb-4">
                <div class="card-body">
                    <table class="tabla" id="tablaEmpresas">
                        <thead>
                            <tr>
                                <th style="">Cedula</th>
                                <th style="">Nombre</th>
                                <th style="">Apellidos</th>
                                <th style="">Empresa</th>
                                <th style="">Cargo</th>
                                <th style="">Sede</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($empleados as $list)
                                <tr>
                                    <td>{{ $list->emp_cedula }}</td>
                                    <td>{{ $list->emp_nombre }}</td>
                                    <td>{{ $list->emp_apellidos }}</td>
                                    <td>{{ $list->empr_nombre }}</td>
                                    <td>{{ $list->emp_cargo }}</td>
                                    <td>{{ $list->sed_nombre }}</td>

                                    <td>
                                        <form action="{{ route('empleado.delete', $list->emp_id) }}" method="POST"
                                            style="display: inline-block; ">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger" rel="tooltip"
                                                onclick="return confirm('Seguro que quiere eliminar esta empleado    ?') ">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                        </form>

                                        <button type="button" class="btn btn-primary" rel="tooltip" data-bs-toggle="modal"
                                            data-bs-target="#EditEmpleado{{ $list->emp_id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                    </td>
                                </tr>
                                @include('empleados.edit')
                            @endforeach

                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        var dataTable = new DataTable("#tablaEmpresas");
    </script>
@endsection
