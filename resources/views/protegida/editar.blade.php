@extends('../layouts.frontend')

@section('content')
    <a href="{{route('protegida_inicio')}}" class="btn btn-warning">volver</a>
    <h1>EDITAR</h1>
    <x-flash></x->
        @if (session('mensaje'))
        <div class="alert alert-{{ session('css') }}">
        {{ session('mensaje') }}
        </div>
@endif
    <form action="{{route('protegida_editar_post', ['id'=>$usuarios->id,'id2'=>$usuarios_d->users_id])}}" method="post">
        <div class="form-group">

            
        </div>

        <div class="form-group">
            <label for="name" class="form-label">Nombre</label>
            <input
                type="text"
                name="name"
                id="name"
                class="form-control"
                value="{{$usuarios->name}}"
            />
            
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Correo</label>
            <input
                type="text"
                name="email"
                id="email"
                class="form-control"
                value="{{$usuarios->email}}"
            />
            
        </div>
        <div class="form-group">
            <label for="telefono" class="form-label">Teléfono</label>
            <input
                type="text"
                name="telefono"
                id="telefono"
                class="form-control"
                value="{{$usuarios_d->telefono}}"
            />
            
        </div>

        <div class="form-group">
            <label for="direccion" class="form-label">Dirección</label>
            <input
                type="text"
                name="direccion"
                id="direccion"
                class="form-control"
                value="{{$usuarios_d->direccion}}"
            />
            
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

