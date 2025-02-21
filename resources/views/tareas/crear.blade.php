@extends('../layouts.frontend')

@section('content')
    <a href="{{route('tareas_paginacion')}}" class="btn btn-warning">volver</a>
    <h1>CREAR</h1>
    <x-flash></x->
    <form action="{{route('tareas_crear_post')}}" method="post">


        <div class="form-group">
            <label for="titulo" class="form-label">título</label>
            <input
                type="text"
                name="titulo"
                id="titulo"
                class="form-control"
                value="{{old('titulo')}}"
            />
            
        </div>
        <div class="form-group">
            <label for="descripcion" class="form-label">descripción</label>
            <input
                type="text"
                name="descripcion"
                id="descripcion"
                class="form-control"
                value="{{old('descripcion')}}"
            />
            
        </div>
        <div class="form-group">
            <label for="autor" class="form-label">autor</label>
            <input
                type="text"
                name="autor"
                id="autor"
                class="form-control"
                value="{{old('autor')}}"
            />
            
        </div>

        

        <hr>
        {{ csrf_field() }}
        @if (session('mensaje'))
        <div class="alert alert-{{ session('css') }}">
        {{ session('mensaje') }}
        </div>
        @endif
        <button
            type="submit"
            class="btn btn-primary"
        >
            Enviar
        </button>
        
    </form>
@endsection

