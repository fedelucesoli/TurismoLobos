@extends('layouts.admin')

@section('content')

        <div class="row">
          <div class="col-md-6">
            <h3>Elementos cargados</h3>
            <br>

            <h4>Alojamientos <span class="label label-success">{{ $alojamiento }}</span></h4>
            <br>
            <h4>Gastronomia <span class="label label-success">{{ $gastronomia }}</span></h4>
            <br>
            <h4>Eventos <span class="label label-success">{{ $evento }}</span></h4>

          </div>


          <div class="col-md-6">
            <h3>Visitas</h3>
            <br>
            <ul class="list-group">
            @foreach ($masvisitadas as $key => $datos)
              <li class="list-group-item">
                <span class="badge">{{ $datos['pageViews'] }}</span>
                {{ $datos['pageTitle'] }}
              </li>
            @endforeach
            </ul>
          </div>

        </div>


@endsection
