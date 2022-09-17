@extends('layouts.main')

@section('title')
    Sedes
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Sedes</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <a>Cantidad: {{ $total }} </a>
                    <form class="d-flex">
                        <button type="button" class="btn btn-primary rounded-pill m-2" rel="tooltip" data-bs-toggle="modal"
                            data-bs-target="#CrearSede">
                            <i class="fas fa-plus"></i>
                        </button>
                    </form>
                </div>
            </div>

            @include('sedes.create')

            @include('layouts.msj')
            @include('sedes.msj')

            <div class="card mb-4">
                <div class="card-body">
                    <table class="tabla" id="tablaSedes">
                        <thead>
                            <tr>
                                <th style="">Nombre</th>
                                <th style="">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($sedes as $list)
                                <tr>
                                    <td>{{ $list->sed_nombre }}</td>

                                    <td>
                                        <form action="{{ route('sede.delete', $list->sed_id) }}" method="POST"
                                            style="display: inline-block; ">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger" rel="tooltip"
                                                onclick="return confirm('Seguro que quiere eliminar esta sede    ?') ">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                        </form>

                                        <button type="button" class="btn btn-primary" rel="tooltip" data-bs-toggle="modal"
                                            data-bs-target="#EditSede{{ $list->sed_id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                    </td>
                                </tr>
                                @include('sedes.edit')
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
        var dataTable = new DataTable("#tablaSedes");
    </script>
@endsection
