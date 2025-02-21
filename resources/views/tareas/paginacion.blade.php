@extends('../layouts.frontend')

@section('content')

<header>
    @if(Auth::check())
    <ul class="nav justify-content-center">
      @if(session('perfil_id')==1)
      <li class="nav-item">
        <h3><a class="nav-link" href="{{route('protegida_inicio')}}">GESTIÓN USUARIOS</a></h3>
      </li>
      @endif
    @endif
</header>
<hr>
    <h1>Tareas</h1>
    <x-flash></x-flash>
    <p class="d-flex justify-content-end">
        <a href="{{ route('tareas_crear') }}" class="btn btn-success">
            CREAR TAREA
        </a>
    </p>
    <p class="d-flex justify-content-end">
        <a href="{{ route('utiles_excel') }}" class="btn btn-success">
            GENERAR EXCEL
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
                                <a href="{{ route('tareas_editar', ['id' => $dato->id]) }}" class="btn btn-warning">Editar</a>
                                <a href="javascript:void(0);" onclick="confirmaAlert('¿Realmente desea eliminar este registro?', '{{ route('tareas_eliminar', ['id' => $dato->id]) }}');" class="btn btn-danger">Eliminar</a>
                                <a href="{{ route('utiles_pdf', ['id' => $dato->id]) }}"class="btn btn-primary">PDF</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$datos->links()}}
    @endif
@endsection
