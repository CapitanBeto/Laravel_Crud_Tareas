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
  <style>/* Additional Dark Mode Styles for Tables */
/* Default light mode styles */
body {
  background-color: white;
  color: black;
  transition: all 0.3s ease;
}

/* Dark mode styles */
body.dark-mode {
  background-color: black;
  color: white;
}

/* Dark mode styles for footer */
body.dark-mode footer {
  background-color: #222;  /* Dark background for footer */
  color: white;            /* Light text color for footer */
}

body.dark-mode footer p {
  color: white;            /* Light text color for the paragraph inside footer */
}

/* Optional: Style the footer links for dark mode */
body.dark-mode footer a {
  color: #f8f9fa; /* Light color for links in footer */
}

body.dark-mode footer a:hover {
  color: #ddd;  /* Lighter color for hover effect */
}

/* Optional: Adjust button styles for dark mode */
button.dark-mode {
  background-color: gray;
  color: black;
}

/* Table dark mode styles */
body.dark-mode table {
  background-color: #444; /* Dark table background */
  color: white;            /* White text */
}

body.dark-mode th,
body.dark-mode td {
  background-color: #555; /* Darker row colors */
}

body.dark-mode th {
  color: #f8f9fa; /* Light color for the table headers */
}

/* Optional: Adjust footer and other elements for dark mode */
body.dark-mode footer {
  background-color: #222 !important;
  color: #ddd !important;
}

  </style>
</head>

<body>
  <div class="container">
    <header class="border-bottom lh-1 py-1">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-1 pt-1 text-start">
          <button
            type="button"
            class="btn btn-dark"
            id="oscuro"
            href="javascript:void(0);"
            onclick="modo()"
          >
            Modo Oscuro
          </button>
        </div>
        <div class="col-3 pt-1"></div>
        
        @if(Auth::check())
        <div class="col-3 text-center">
          <a class="blog-header-logo text-body-emphasis text-decoration-none" href="{{ route('tareas_paginacion') }}">
            <img src="{{ asset('/img/thps3.png') }}" width="200px" />
          </a>
        </div>
        @else
        <div class="col-3 text-center">
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
              href="javascript:void(0);"
              onclick="confirmaAlert('Vas a salir de la sesión', '{{route('acceso_salir')}}')"
            >
              Cerrar sesión
            </button>
          </div>
          @endif
      </div>
    </header>

    <!-- Main Content Section -->
    <main>
      @yield('content')
    </main>

    <footer class="py-5 text-center text-body-secondary bg-body-tertiary">
      <p>Todos los derechos reservados - desarrollado por Francisco Barrena</p>
    </footer>

    <!-- JavaScript Libraries -->
    <script src="{{asset('js/jquery-2.0.0.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/jquery.alerts.min.js')}}"></script>
    <script src="{{asset('js/funciones.js')}}?id={{ csrf_token() }}"></script>


  </div>
</body>
</html>
