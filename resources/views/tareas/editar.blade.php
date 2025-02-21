@extends('../layouts.frontend')

@section('content')
    <a href="{{route('tareas_paginacion')}}" class="btn btn-warning">volver</a>
    <h1>EDITAR</h1>
    <x-flash></x->
        @if (session('mensaje'))
        <div class="alert alert-{{ session('css') }}">
        {{ session('mensaje') }}
        </div>
@endif
    <form action="{{route('tareas_editar_post', ['id'=>$tareas->id])}}" method="post">
        <div class="form-group">
            
        </div>

        <div class="form-group">
            <label for="titulo" class="form-label">título</label>
            <input
                type="text"
                name="titulo"
                id="titulo"
                class="form-control"
                value="{{$tareas->titulo}}"
            />
            
        </div>
        <div class="form-group">
            <label for="descripcion" class="form-label">descripción</label>
            <input
                type="text"
                name="descripcion"
                id="descripcion"
                class="form-control"
                value="{{$tareas->descripcion}}"
            />
            
        </div>

            
        </div>
        
        

        <hr>
        {{ csrf_field() }}

        <button
            type="submit"
            class="btn btn-primary"
        >
            Enviar
        </button>
        
    </form>
@endsection

