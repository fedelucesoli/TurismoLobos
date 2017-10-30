@extends('layouts.admin')

@section('content')
<div class="col-md-6">
  <h1>Alojamiento</h1>
</div>
<div class="col-md-6 text-right">
  <a type="button" class="btn btn-default" style="margin-top: 20px;" href="" data-toggle="modal" data-target="#modal">Categorias</a>
  <a type="button" class="btn btn-default" style="margin-top: 20px;" href="{{route('admin.alojamiento.create')}}"  >Agregar Alojamiento</a>
</div>
<hr>
<div class="col-md-12">
@empty ($alojamientos)
  <h3 class="text-center">No hay Alojamientos cargados</h3>
@endempty
  @isset ($alojamientos)
    <table class="table table-striped" cellspacing="0" width="100%" style="margin-top:25px;">
        <thead>
            <tr>
              <th><h5>Nombre</h5></th>
              <th style="width:10%"><h5 >Estado</h5></th>
              <th style="width: 25%"><h5 >Acciones</h5></th>
            </tr>
        </thead>
        <tbody>
          @foreach ($alojamientos as $item)
            <tr>
              {{-- <td style="vertical-align: middle"><h6>{{$item->id}}</h6></td> --}}

              <td><h4 data-href="{{route('admin.alojamiento.show', $item->id)}}">{{$item->nombre}} <small>{{$item->categoria->nombre}}</small></h4></td>
              <td style="vertical-align: middle">
                <button
                  type="button"
                  onclick="toggleEstado()"
                  @if ($item->activo)
                    class="estado btn-xs btn btn-info">
                    Publicado

                  @else
                    class="estado btn-xs btn btn-success">
                    Borrador
                  @endif
                </button>

              </td>
              <td style="vertical-align: middle">
                <a role="button" class="btn btn-default btn-sm" href="{{route('admin.gastronomia.edit', $item->id)}}"><i class="fa fa-pencil"> </i> Editar</a>
                {{ Form::open(['method' => 'DELETE', 'route' => ['admin.alojamiento.destroy', $item->id], 'style' => 'display: inline', 'class' => 'form-delete']) }}
                {{ Form::hidden('id', $item->id) }}
                {{ Form::button('<i class="fa fa-trash"> </i> Eliminar', ['type'=>'submit', 'class' => 'btn btn-sm btn-danger']) }}
                {{ Form::close() }}
              </td>
            </tr>
          @endforeach
       </tbody>
    </table>
  @endisset
{{ $alojamientos->links() }}
</div>

@component('admin.partials.modal', [
  'categorias' => $categorias,
  'titulo' => "Categorias",
  'include' => 'admin/partials/categorias',
  'parent' => 'alojamientos',
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
