@extends('../layouts.frontend')

@section('content')

<x-flash></x->

    <style>
        .division{
    width:20px;
    height:auto;
    display:inline-block;
}
    </style>


<br>

    <nav class="nav justify-content-center">
        
        <a href="{{route('acceso_registro')}}" class = "btn btn-warning" name="boton">Registro</a>
        <div class= division></div>
        <a href="{{route('acceso_login')}}" class = "btn btn-success" name="boton">Login</a>
        <div class= division></div>
        <a href="{{route('acceso_login')}}" class = "btn btn-primary" name="boton">Home</a>
      </nav>
      <br>

@endsection
