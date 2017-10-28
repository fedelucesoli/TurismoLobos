<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Turismo en Lobos') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Domine:400,700|Montserrat:300,400,700" rel="stylesheet" type='text/css'>
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/turismolobos.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body>
  @include('layouts.navbar')


  {{-- @include('admin.partials.nav') --}}

    <div class="container" style="margin-top: 120px;">

      <div class="row">
        <div class="col-md-2">
          <div class="list-group">
            <a href="{{route('admin.gastronomia.index')}}" class="list-group-item">Gastronomia</a>
            <a href="{{route('admin.alojamiento.index')}}" class="list-group-item">Alojamiento</a>
            <a href="{{route('admin.eventos.index')}}" class="list-group-item">Eventos</a>
            <a href="{{route('admin.lugar.index')}}" class="list-group-item">Lugares</a>
            {{-- <a href="{{route('admin.categorias.index')}}" class="list-group-item">Categorias</a> --}}
            <hr>
            <a data-toggle="collapse" href="#collapse1"class="list-group-item">Usuario</a>
            <div id="collapse1" class="panel-collapse collapse">
              <ul class="list-group">
                <li class="list-group-item">Configuracion</li>
                <li class="list-group-item">Cerrar Sesion</li>
              </ul>

            </div>



          </div>
        </div>
        <div class="col-md-10">
          @if (isset($errors) && count($errors->all()) > 0)
          <div class="alert alert-danger cms-alert">
              <a class="close" data-dismiss="alert">×</a>
              Por favor revisa los errores!
          </div>
          @endif

          <?php $types = ['success', 'error', 'warning', 'info']; ?>

          @foreach ($types as $type)
              @if ($message = Session::get($type))
              <?php if ($type === 'error') $type = 'danger'; ?>
              <div class="alert alert-{{ $type }} cms-alert">
                  <a class="close" data-dismiss="alert">×</a>
                  {!! $message !!}
              </div>
              @endif
          @endforeach


          <div class="panel panel-default">
            {{-- <div class="panel-heading">TurismoCMS</div> --}}
            <div class="panel-body">
              @yield('content')
            </div>
          </div>

        </div>
      </div>
    </div>



    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" charset="utf-8"></script>
    <script>
      $("#menu-toggle").click(function(e) {
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
      });
    </script>
    @stack('scripts')
</body>
</html>
