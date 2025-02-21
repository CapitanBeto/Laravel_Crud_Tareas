@extends('../layouts.frontend')

@section('content')
    <h1>ADMINS</h1>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $dato)
                    @php
                        $datos_u = $datos_u->firstwhere('users_id',$dato->id)
                    @endphp
                    @if (($datos_u->perfil_id)!=1)
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
                                <a href="javascript:void(0);" onclick="confirmaAlert('¿Realmente desea eliminar este registro?', '{{ route('tareas_eliminar', ['id' => $dato->id]) }}');">
                                    <i class="btn btn-danger">Eliminar</i>
                                </a>
                                
                            </td>
                        </tr>
                    @endif
                    @endforeach




                </tbody>
            </table>
        </div>

    @endif
@endsection