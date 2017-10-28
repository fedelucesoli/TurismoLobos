{{ Form::open([
  'url' => 'admin/categorias',
  'files' => true,
  'class' => 'form-inline categorias',
  'method' => 'POST'
  ])}}

  {{ Form::hidden ('parent', $parent, array('class' => 'form-control')) }}
  {{ Form::hidden ('editar', 0, array('class' => 'form-control')) }}

<div class="form-group @if ($errors->has('titulo')) has-error @endif">
  {{ Form::label('nombre', "Nombre", ['class' => 'control-label ']) }}
  {{ Form::text('nombre', null, array('class' => 'form-control')) }}
  @if ($errors->has('nombre'))<p class="help-block">{{ $errors->first('nombre') }}</p>@endif
  {{ Form::submit('Guardar', ['class'=>'btn btn-danger'] )}}
</div>

{{ Form::close() }}
<div class="alert hidden alert-danger" style="margin-top: 20px" role="alert">
<a class="close" data-dismiss="alert">×</a>
<p></p>
</div>
<table class="table table-hover" cellspacing="0" width="100%" style="margin-top:25px;">

    <tbody id="categorias">
      @foreach ($categorias as $item)
        <tr data-id="{{$item->id}}">
          {{-- <td style="width:7%" class="text-center"><h6>{{$item->id}}</h6></td> --}}
          <td style="vertical-align: middle">{{$item->nombre}}</td>

          <td style="vertical-align: middle;" class="text-right">
            {{-- <a href="#editar" data-id="{{$item->id}}" data-val="{{$item->nombre}}" class="btn btn-default">Editar</a> --}}
            <a href="#eliminar" data-id="{{$item->id}}" class="btn btn-default">Eliminar</a>
          </td>
        </tr>
      @endforeach
   </tbody>

</table>


@push('scripts')
  <script type="text/javascript">
    $('.categorias').submit(function(e) {
      e.preventDefault();
      $.ajax({
        headers: {'X-CSRF-TOKEN':"{{ csrf_token() }}"},
        method: 'POST',
        type: 'POST',
        data: {
          'nombre':  $('input[name="nombre"]').val(),
          'parent': $('input[name="parent"]').val(),
        },
        url: '/admin/categorias',
        success: function(result) {
         console.log('response: '+ result.nombre);
         $('#categorias').append('<tr data-id="'+result.id+'"> <td style="vertical-align: middle">'+result.nombre+'</td> <td style="vertical-align: middle;" class="text-right"> <a href="#eliminar" data-id="'+result.id+'" class="btn btn-default">Eliminar</a> </td> </tr>');

       },
       error: function(result){
         $('.alert p').html('No se pudo guardar :( ').removeClass('hidden');
       }
      });
    });
    // $(document).on('click', 'a[href="#editar"]',function(e) {
    //   e.preventDefault();
    //   var element = this;
    //   $('input[name="nombre"]').val($(this).data('val'));
    //   $('input[name="editar"]').val(1);
    //   $('input[type="submit"]').val('Editar');
    // });

    $(document).on('click', 'a[href="#eliminar"]',function(e) {
      e.preventDefault();
      var element = this;
      $.ajax({
        headers: {'X-CSRF-TOKEN':"{{ csrf_token() }}"},
        method: "DELETE",
        type: "DELETE",
        data: {
          'id':  $(this).data('id')
        },
        url: '/admin/categorias/'+$(this).data('id'),
        success: function(result) {
          element.closest("tr").remove();
          console.log(result);
          console.log(result.mensaje);
          $('.alert p').html(result.mensaje).removeClass('hidden');
       },
       error: function(result){
         $('.alert p').html(result.mensaje).removeClass('hidden');
       }
      });
    });
  </script>
@endpush
