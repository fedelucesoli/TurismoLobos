<div class="col-md-5" style="margin-bottom: 15px;">
  <a type="button" class="btn btn-default" style="" href="{{route($url.'.index')}}"> <i class="fa fa-arrow-left"></i> Volver</a>

  {{ Form::open(['method' => 'PUT', 'route' => [$url.'.update', $item->id], 'style' => 'display: inline', 'class' => '']) }}
  {{ Form::hidden('id', $item->id) }}
  {{ Form::hidden('formActivar', 1) }}
  @if ($item->activo)
    {{ Form::hidden('activo', 0) }}

    {{ Form::submit('No publicar', ['class' => 'btn btn-default']) }}
  @else
    {{ Form::hidden('activo', 1) }}

    {{ Form::submit('Publicar', ['class' => 'btn btn-success']) }}

  @endif

  {{ Form::close() }}

  {{-- <button
    data-id="{{$item->id}}"
    type="button"
    onclick="toggleEstado(this)"
    @if ($item->activo)
      class="estado btn btn-info">
      No publicar

    @else
      class="estado btn btn-success">
      Publicar
    @endif
  </button> --}}

  {{ Form::open(['method' => 'DELETE', 'route' => [$url.'.destroy', $item->id], 'style' => 'display: inline', 'class' => 'form-delete']) }}
  {{ Form::hidden('id', $item->id) }}
  {{ Form::submit('Eliminar', ['class' => 'btn btn-danger']) }}
  {{ Form::close() }}



</div>
<div class="col-md-7 text-right">
  <ul class="list-inline">
  <li class="text-left">
    <h6>CREADO</h6>
    <h5 class="text-muted">{{date_format($item->created_at,"d/m/Y - H:i") }}</h5>
  </li>
  {{-- <li class="text-left">
    <h6>CREADO POR</h6>
    <h5 class="text-muted">{{ Auth::user()->name }}</h5>
  </li> --}}
  <li class="text-left">
    <h6>ESTADO</h6>
    <h5 class="text-muted">@if ($item->activo)Publicado @else Borrador @endif</h5>
  </li>
  </ul>
</div>
<div class="col-md-12">
  <hr>
</div>
@include('admin.partials.delete')

@push('scripts')
<script type="text/javascript">

$('.form-delete').on('click', function(e){
    e.preventDefault();
    var $form=$(this);
    $('#delete').modal({ backdrop: 'static', keyboard: false })
        .on('click', '#delete-btn', function(){
            $form.submit();
        });
});

</script>
@endpush
