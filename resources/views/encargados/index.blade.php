@extends('layouts.main')

@section('title')
Encargados
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Encargados</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <a>Cantidad: {{ $total }} </a>
                    <form class="d-flex">
                        <button type="button" class="btn btn-primary rounded-pill m-2" rel="tooltip" data-bs-toggle="modal"
                            data-bs-target="#CrearEncargado">
                            <i class="fas fa-plus"></i>
                        </button>
                    </form>
                </div>
            </div>

            @include('encargados.create')

            @include('layouts.msj')
            @include('encargados.msj')

            <div class="card mb-4">
                <div class="card-body">
                    <table class="tabla" id="tablaEncargados">
                        <thead>
                            <tr>
                                <th style="">Cedula</th>
                                <th style="">Nombre</th>
                                <th style="">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($encargados as $list)
                                <tr>
                                    <td>{{ $list->enc_cedula }}</td>
                                    <td>{{ $list->enc_nombre }}</td>

                                    <td>
                                        <form action="{{ route('encargado.delete', $list->enc_id) }}" method="POST"
                                            style="display: inline-block; ">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger" rel="tooltip"
                                                onclick="return confirm('Seguro que quiere eliminar este encargado ?') ">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                        </form>

                                        <button type="button" class="btn btn-primary" rel="tooltip" data-bs-toggle="modal"
                                            data-bs-target="#EditEncargado{{ $list->enc_id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                    </td>
                                </tr>

                                @include('encargados.edit')
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
        var dataTable = new DataTable("#tablaEncargados");
    </script>
@endsection
