@extends('layouts.admin')

@section('content')

  @component('admin.partials.modal', [
    'titulo' => "Galeria de imágenes",
    'include' => 'admin/forms/galeria',
  ])
  @endcomponent
  @include('admin.partials.detalles-item', ['item' => $item, 'url' => 'admin.eventos'])

    @isset($imagenes)
      <div class="col-md-12 text-center">

      @foreach($imagenes as $imagen)
        <img
        src='{{asset("uploads/full_size/$imagen->filename")}}'
        height="150px"
        >

      @endforeach
      <hr>
    </div>
    @endisset
  @isset (!$imagenes)
    <div class="col-md-12 text-center">
      fede
    <div>
  @endisset

<div class="col-md-10 col-md-offset-2">
  <h4 class="text-muted">{{$item->categoria->nombre}}</h4>
  <h1>{{$item->titulo}}</h1>
  <hr>
</div>

<div class="col-md-12">
  {{ Form::open([
    'route' => ["admin.eventos.update", $item->id],
    'files' => true,
    'class' => 'form-horizontal',
    'method' => 'PUT'
    ])}}
    {{ Form::hidden('_method', 'PUT')}}
  <div class="form-group @if ($errors->has('titulo')) has-error @endif">
    {{ Form::label('titulo', "Titulo", ['class' => 'control-label col-sm-2']) }}
    <div class="col-sm-8">
      {{ Form::text('titulo', $item->titulo, array('class' => 'form-control')) }}
      @if ($errors->has('titulo'))<p class="help-block">{{ $errors->first('titulo') }}</p>@endif
    </div>
  </div>

  <div class="form-group @if ($errors->has('categoria')) has-error @endif">
    {{ Form::label('categoria', "Categoria", ['class' => 'control-label col-sm-2']) }}
    <div class="col-sm-8">
      {{ Form::select('categoria', $categorias->pluck('nombre', 'id'), $item->categoria->id, ['placeholder' => 'Categoria', 'class' => 'select form-control']) }}
      @if ($errors->has('categoria'))<p class="help-block">{{ $errors->first('categoria') }}</p>@endif
    </div>
  </div>

  <div class="form-group ">
    {{ Form::label('fecha', "Fecha", ['class' => 'control-label col-sm-2']) }}
    <div class="col-sm-3">
      {{ Form::date('fecha', $item->fecha, array('class' => 'form-control')) }}
      @if ($errors->has('fecha'))<p class="help-block">{{ $errors->first('fecha') }}</p>@endif
    </div>

    {{ Form::label('hora', "Hora", ['class' => 'control-label col-sm-2']) }}
    <div class="col-sm-3">
      {{ Form::time('hora', $item->hora, array('class' => 'form-control')) }}
      @if ($errors->has('hora'))<p class="help-block">{{ $errors->first('hora') }}</p>@endif
    </div>
  </div>

  <div class="form-group @if ($errors->has('lugar')) has-error @endif">
    {{ Form::label('lugar', "Lugar", ['class' => 'control-label col-sm-2']) }}
    <div class="col-sm-8">
      {{ Form::select('lugar', $lugares->pluck('nombre', 'id'), $item->lugar_id, ['placeholder' => 'Lugar', 'class' => 'select form-control']) }}
      @if ($errors->has('lugar'))<p class="help-block">{{ $errors->first('categoria') }}</p>@endif
    </div>
  </div>

  <div class="form-group @if ($errors->has('descripcion')) has-error @endif">
    {{ Form::label('descripcion', "Descripción", ['class' => 'control-label col-sm-2']) }}
    <div class="col-sm-8">
      {{ Form::textarea('descripcion', $item->descripcion, array('class' => 'form-control', 'id' => 'summernote')) }}
      @if ($errors->has('descripcion'))<p class="help-block">{{ $errors->first('descripcion') }}</p>@endif
    </div>
  </div>

  <hr>

  <div class="form-group">
   <div class="col-sm-8 col-sm-offset-2 text-right">
    <a href="{{url()->previous()}}" class="btn btn-primary">Cancelar</a>
    {{ Form::submit('Guardar', ['class'=>'btn btn-danger'] )}}
   </div>
  </div>

  {{ Form::close() }}

</div>


@endsection

@push('scripts')
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
<script>
  $('#summernote').summernote({
    height: 300,
    minHeight: null,
    maxHeight: null,
    fontNames: ['Domine', 'Montserrat'],
    toolbar: [
       ['style', ['bold', 'italic', 'underline', 'clear']],
       ['fontsize', ['fontsize']],
       ['color', ['color']],
       ['para', ['ul', 'ol', 'paragraph']],

    ],

  });


  </script>
@endpush
