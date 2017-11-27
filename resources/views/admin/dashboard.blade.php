@extends('layouts.admin')

@section('content')

        <h1>Inicio</h1>
        {{-- {{ dd($masvisitadas)}} --}}
        <ul>

        @foreach ($masvisitadas as $key => $datos)
          <li>

            <strong>Pagina: </strong> {{ $datos['pageTitle'] }}
            <strong>Visitantes: </strong> {{ $datos['pageViews'] }}
          </li>
        @endforeach
      </ul>

@endsection
