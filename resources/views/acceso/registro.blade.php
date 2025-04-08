@extends('../layouts.frontend')

@section('content')
<a href="{{ route('tareas_inicio') }}" class="btn btn-warning">volver</a>
    <h1>Registro</h1>
    <x-flash />
    @if (session('mensaje'))
    <div class="alert alert-{{ session('css') }}">
    {{ session('mensaje') }}
    </div>
@endif
    <div>
    <form action="{{route('acceso_registro_post')}}" method=POST>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" class="form-control"
        value="{{old('nombre')}}"/>
    </div>
    <div>
        <label for="correo">Correo:</label>
        <input type="text" name="correo" id="correo" class="form-control"
        value="{{old('correo')}}"/>
    </div>
    <div>
        
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" class="form-control"
            value="{{old('telefono')}}"/>
    </div>
    <div>
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="direccion" class="form-control"
            value="{{old('direccion')}}"/>
    </div>
    <div>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" class="form-control
            "/>
    </div>
    <div>
            <label for="password_confirmation">Contraseña:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control
            "/>
    </div>
    {{ csrf_field() }}
    <button
        type="submit"
        class="btn btn-primary"
    >
        Enviar
    </button>
    
    </form>
@endsection