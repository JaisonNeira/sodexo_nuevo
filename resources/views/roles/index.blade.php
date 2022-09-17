@extends('layouts.main')

@section('title')
Roles
@endsection

@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Roles</h1>
        <div class="card mb-4">
            <div class="card-body">
                <a>Cantidad: {{$total}}</a>
                <form class="d-flex">
                      <a type="button" class="btn btn-success rounded-pill m-2" href="{{route('GuardarRol')}}"><i class="fas fa-plus"></i></a>
                </form>
            </div>
        </div>

        @include('layouts.msj')
        @include('usuarios.msj')

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>

            </div>
            <div class="card-body">
                <table class="table" id="tablaRoles">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>

                                @can('borrar-rol')
                                <form action="{{ route('BorrarRol', $role->id) }}" method="POST"
                                    style="display: inline-block; ">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger" rel="tooltip"
                                        onclick="return confirm('Seguro que quiere eliminar este Rol?') ">
                                        <i class="fas fa-trash-alt" title="Eliminar Registro"></i>
                                    </button>

                                </form>
                                @endcan

                                @can('editar-rol')
                                    <a class="btn btn-primary" href="{{ route('EditarRol',$role->id) }}"> <i class='bx bxs-edit-alt bx-xs'></i></a>
                                @endcan
                            </td>
                        </tr>
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
    var dataTable = new DataTable("#tablaRoles");
</script>

@endsection


