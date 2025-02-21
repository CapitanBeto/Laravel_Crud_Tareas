@extends('../layouts.frontend')

@section('content')
    <h1>Login</h1>
    <x-flash />
    @if (session('mensaje'))
    <div class="alert alert-{{ session('css') }}">
    {{ session('mensaje') }}
    </div>
@endif
<form action="{{route('acceso_login_post')}}" method = "POST">
    {{ csrf_field() }}
    <div>
        <label for="correo">Correo:</label>
        <input type="text" name="correo" id="correo" class="form-control"
        value="{{old('correo')}}"/>
    </div>
    <div>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" class="form-control
            "/>
    </div>


    <button
        type="submit"
        class="btn btn-primary"
    >
        Entrar
    </button>
    
    </form>
@endsection