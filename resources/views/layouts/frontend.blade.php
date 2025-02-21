<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>El gran CRUD</title>
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
  <link rel="shortcut icon" href="{{asset('img/thps3.png')}}" type="image/x-icon">
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <link href="{{asset('css/jquery.alerts.min.css')}}" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900&amp;display=swap" rel="stylesheet"/>
  <link href="{{asset('css/blog.css')}}" rel="stylesheet"/>
  <style>
    body, html {
        overflow-x: hidden;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    .suggestion-bubble {
        display: none;
        position: absolute;
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        width: 220px;
        text-align: center;
        z-index: 10;
    }

    .suggestion-bubble .arrow {
        position: absolute;
        bottom: -10px;
        left: 20px;
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-top: 10px solid #f8f9fa;
    }
  </style>

  
</head>
<body>
  
  <div class="container">
    <header class="border-bottom lh-1 py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1"></div>
        @if(Auth::check())
        <div class="col-4 text-center">
          <a class="blog-header-logo text-body-emphasis text-decoration-none" href="{{ route('tareas_paginacion') }}">
            <img src="{{ asset('/img/thps3.png') }}" width="200px" />
          </a>
        </div>
        
        @else
        <div class="col-4 text-center">
          <a class="blog-header-logo text-body-emphasis text-decoration-none" href="{{ route('tareas_inicio') }}">
            <img src="{{ asset('/img/thps3.png') }}" width="200px" />
          </a>
        </div>
        @endif
        <div class="col-4 pt-1 text-end">

          @if(Auth::check())
          
            <a >Hola {{ Auth::user()->name }} ({{ session('perfil') }})</a>
            <br><br>
            <button
              type="button"
              class="btn btn-danger"
              href="javascript:void(0);" onclick="confirmaAlert('Vas a salir de la sesión', '{{route('acceso_salir')}}')"
            >
              Cerrar sesión
            </button>
            
            
            
          @endif
            

    </header>



    
      @yield('content')
    </main>

    <footer class="py-5 text-center text-body-secondary bg-body-tertiary">
      <p>Todos los derechos reservados - desarrollado por Francisco Barrena
        
      </p>
      <script src="{{asset('js/jquery-2.0.0.min.js')}}"></script>
      <script src="{{asset('js/bootstrap.js')}}"></script>
      <script src="{{asset('js/jquery.alerts.min.js')}}"></script>
      <script src="{{asset('js/funciones.js')}}?id={{ csrf_token() }}"></script>
      @stack('js')
    </footer>
  </div>
</body>
</html>
