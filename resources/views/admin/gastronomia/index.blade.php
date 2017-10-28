@extends('layouts.admin')

@section('content')
<div class="col-md-6">
  <h1>Gastronomia</h1>
</div>
<div class="col-md-6 text-right">
  <a type="button" class="btn btn-default" style="margin-top: 20px;" href="" data-toggle="modal" data-target="#modal">Categorias</a>
  <a type="button" class="btn btn-default" style="margin-top: 20px;" href="{{route('admin.gastronomia.create')}}">Agregar Local Gastronomico</a>
</div>
<hr>

<div class="col-md-12">
@empty ($gastronomia)
  <h3 class="text-center">No hay Locales Gastronómicos cargados</h3>
@endempty
  @isset ($gastronomia)
    <table class="table table-hover" cellspacing="0" width="100%" style="margin-top:25px;">
        <thead>
            <tr>
              <th style="width:7%"><h5>#</h5></th>
              <th><h5>Nombre</h5></th>
              <th style="width:10%"><h5 >Estado</h5></th>
              <th style="width: 25%"><h5 >Acciones</h5></th>
            </tr>
        </thead>
        <tbody>
          @foreach ($gastronomia as $item)
            <tr>
              <td style="vertical-align: middle"><h6>{{$item->id}}</h6></td>

              <td><h4 data-href="{{route('admin.gastronomia.show', $item->id)}}">{{$item->nombre}} <small>{{$item->categoria}}</small></h4></td>
              <td style="vertical-align: middle">
                @component('admin.partials.activo', ['item' => $item, 'url' => 'gastronomia'])
                @endcomponent
              </td>
              <td style="vertical-align: middle">
                <a role="button" class="btn btn-default btn-sm" href="{{route('admin.gastronomia.edit', $item->id)}}"><i class="fa fa-pencil"> </i> Editar</a>

                {{ Form::open(['method' => 'DELETE', 'route' => ['admin.gastronomia.destroy', $item->id], 'style' => 'display: inline', 'class' => 'form-delete']) }}
                {{ Form::hidden('id', $item->id) }}
                {{ Form::button('<i class="fa fa-trash"> </i> Eliminar', [ 'type' => 'submit', 'class' => 'btn btn-sm btn-danger']) }}
                {{ Form::close() }}

              </td>
            </tr>
          @endforeach
       </tbody>
    </table>
  @endisset

</div>

@component('admin.partials.modal', [
  'categorias' => $categorias,
  'titulo' => "Categorias",
  'include' => 'admin/partials/categorias',
  'parent' => 'gastronomia',
])

@endcomponent

@include('admin.partials.delete')

@endsection



@push('scripts')
<script type="text/javascript">
$('h4[data-href]').on("click", function() {
  document.location = $(this).data('href');

});

$('table').on('click', '.form-delete', function(e){
    e.preventDefault();
    var $form=$(this);
    $('#delete').modal({ backdrop: 'static', keyboard: false })
        .on('click', '#delete-btn', function(){
            $form.submit();
        });
});
</script>
@endpush
