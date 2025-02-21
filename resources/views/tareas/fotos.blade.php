@extends('../layouts.frontend')

@section('content')
<a href="{{route('tareas_paginacion')}}" class="btn btn-warning">volver</a>
<h1>fotos de la tarea : {{$tareas->titulo}}</h1>
<h4>por: {{$tareas->autor}}</h4>
<x-flash></x->
    <form action="{{route('tareas_fotos_post',['id'=>$tareas->id])}}" method="post" name="form" enctype="multipart/form-data">
    <div class="row">
        <div class="form-group left">
            <label for="foto">Foto</label>
            <input type="file" name="fotos[]" id="foto" class="form-control" multiple/>

        </div>
    </div>

<hr>
{{ csrf_field() }}
<input type="submit" value="Enviar" class="btn btn-primary"/>
</form>
@if (session('mensaje'))
<div class="alert alert-{{ session('css') }}">
{{ session('mensaje') }}
</div>
@endif
<div
    class="table-responsive"
>
    <table
        class="table table-primary"
    >
        <thead>
            <tr>
                <th scope="col">Fotos</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if($fotos->isEmpty())
            <div class="alert alert-info text-center">
                No hay fotos registradas.
            </div>
            @else
            @foreach ( $fotos as $foto )
                <tr>
                    <td>
                        <img src="{{asset('uploads/fotos/')}}/{{$foto->nombre}}" width="200" height="200"/>
                    </td>
                    <td>
                        
                        <a href="javascript:void(0);" onclick="confirmaAlert('¿Realmente desea eliminar esta imágen?', '{{ route('tareas_fotos_eliminar', ['id' => $tareas->id, 'foto_id'=>$foto->id]) }}');">
                            <i class="btn btn-danger">Eliminar</i>

                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>


@endsection
