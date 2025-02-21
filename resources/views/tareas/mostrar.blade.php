@extends('../layouts.frontend')

@section('content')
    <h1>Tareas</h1>
    <x-flash></x-flash>
    <a href="{{route('tareas_paginacion')}}">Paginación</a>
    <p class="d-flex justify-content-end">
        <a href="{{ route('tareas_crear') }}" class="btn btn-success">
            <i></i> Crear
        </a>
    </p>
    
    @if($datos->isEmpty())
        <div class="alert alert-info text-center">
            No hay tareas registradas.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Autor</th>
                        <th>Fecha creación</th>
                        <th>Hora creación</th>
                        <th>Fotos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $dato)
                        <tr>
                            <td>{{ $dato->id }}</td>
                            <td>{{ $dato->titulo }}</td>
                            <td>{{ $dato->descripcion }}</td>
                            <td>{{ $dato->autor }}</td>
                            <td>{{ $dato->fecha }}</td>
                            <td>{{ $dato->hora }}</td>
                            <td><a href="{{ route('tareas_fotos', ['id' => $dato->id]) }}">
                                <i class="btn btn-info">ver fotos</i>
                            </td>
                            <td>
                                <a href="{{ route('tareas_editar', ['id' => $dato->id]) }}">
                                    <i class="btn btn-warning">Editar</i>
                                </a>
                                <a href="javascript:void(0);" onclick="confirmaAlert('¿Realmente desea eliminar este registro?', '{{ route('tareas_eliminar', ['id' => $dato->id]) }}');">
                                    <i class="btn btn-danger">Eliminar</i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @endif
@endsection
