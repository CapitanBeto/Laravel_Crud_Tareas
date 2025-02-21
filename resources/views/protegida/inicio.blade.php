@extends('../layouts.frontend')

@section('content')
<header>
    @if (session('mensaje'))
    <div class="alert alert-{{ session('css') }}">
    {{ session('mensaje') }}
    </div>
@endif
    @if(Auth::check())
    <ul class="nav justify-content-center">
      @if(session('perfil_id')==1)
      <li class="nav-item">
        <h4><a class="nav-link" href="{{route('tareas_paginacion')}}">LISTA DE TAREAS</a></h4>
      </li>

      @endif

    @endif

</header>

<hr>
    <h1>USUARIOS</h1>
    <x-flash></x-flash>
    
    @if($datos->isEmpty())
        <div class="alert alert-info text-center">
            No hay usuarios.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                        <th>Privilegios</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $dato)
                    @php
                        $datos_u = $datos_u->firstwhere('users_id',$dato->id)
                    @endphp
                        <tr>
                            <td>{{ $dato->id }}</td>
                            <td>{{ $dato->name }}</td>
                            <td>{{ $dato->email }}</td>
                            <td>{{ $datos_u->telefono}}</td>
                            <td>{{ $datos_u->direccion}}</td>
                            <td>
                                <a href="{{ route('protegida_editar', ['id' => $dato->id, 'id2'=>$datos_u->users_id]) }}">
                                    <i class="btn btn-warning">Editar</i>
                                </a>
                                <a href="javascript:void(0);" onclick="confirmaAlert('¿Realmente desea eliminar este registro?', '{{ route('protegida_eliminar',['id' => $dato->id]) }}');">
                                    <i class="btn btn-danger">Eliminar</i>
                                </a>
                                @if(session('perfil_id')==1)
                                @if($datos_u->perfil_id == 2)
                                <a href="{{ route('protegida_privilegios', ['id'=>$dato->id]) }}">
                                    <i class="btn btn-success">HACER ADMIN</i>
                                </a>
                                @endif
                                @endif
                                
                            </td>
                            <td>
                                
                                  @if($datos_u->perfil_id == 1)
                                  <p class="text-warning">ADMIN</p>
                                  @else
                                  USUARIO
                                  @endif
                                </td>
                        </tr>
                    @endforeach




                </tbody>
            </table>
        </div>

    @endif
@endsection