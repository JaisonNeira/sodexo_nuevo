@extends('layouts.main')

@section('title')
    Empresas
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Empresas</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <a>Cantidad: {{ $total }} </a>
                    <form class="d-flex">
                        <button type="button" class="btn btn-primary rounded-pill m-2" rel="tooltip" data-bs-toggle="modal"
                            data-bs-target="#CrearEmpresa">
                            <i class="fas fa-plus"></i>
                        </button>
                    </form>
                </div>
            </div>

            @include('empresas.create')

            @include('layouts.msj')

            <div class="card mb-4">
                <div class="card-body">
                    <table class="tabla" id="tablaEmpresas">
                        <thead>
                            <tr>
                                <th style="">NIT</th>
                                <th style="">Nombre</th>
                                <th style="">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($empresas as $list)
                                <tr>
                                    <td>{{ $list->empr_nit }}</td>
                                    <td>{{ $list->empr_nombre }}</td>

                                    <td>
                                        <form action="{{ route('empresa.delete', $list->empr_id) }}" method="POST"
                                            style="display: inline-block; ">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger" rel="tooltip"
                                                onclick="return confirm('Seguro que quiere eliminar esta empresa    ?') ">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                        </form>

                                        <button type="button" class="btn btn-primary" rel="tooltip" data-bs-toggle="modal"
                                            data-bs-target="#EditEmpresa{{ $list->empr_id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                    </td>
                                </tr>
                                @include('empresas.edit')
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
