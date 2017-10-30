<?php

namespace App\Http\Controllers\Admin;


use App\Models\Lugar;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Logic\MapasRepository;


class LugarController extends Controller
{
  public function __construct(MapasRepository $MapaRepository){
  $this->middleware('auth');
  $this->mapa = $MapaRepository;
}
  public function index()
  {
    $data['lugares'] = Lugar::all();
    $data['categorias'] = Categoria::where('parent', 'lugares')->get();
    return view('admin.lugar.index', $data);
  }

  public function create()
  {
    $data['lugar'] = new Lugar;
    $data['map'] = $this->mapa->addMarkerMap();

    $data['categorias'] = Categoria::where('parent', 'gastronomia')->get();
    return view('admin.lugar.form', $data);
  }

  public function store(Request $request)
  {
    $rules = array(
      'nombre'            => 'required|max:140',
      'direccion'         => 'required',
      'localidad'         => 'required',
    );
    $validator = $this->validate($request, $rules);

    $item = new Lugar;
    $item->fill($request->all());
    $item->activo = 1;
    $item->usuario_id = $request->user()->id;
    $item->save();

    if ($item->save()) {
      $request->session()->flash('status', 'Guardado!');
    }else{
      $request->session()->flash('status', 'No se pudo guardar. :(');
    }
      return redirect()->route('admin.lugar.index');
  }

  public function show(Lugar $lugar)
  {
    $data['item'] = $lugar;
    if(is_null($data['item'])){
      $request->session()->flash('status', ':( No lo encontre!');
      return redirect()->route('admin.lugar.index');
    }
    $data['map'] = $this->mapa->showMarkerMap($data['item']);

    return view('admin.lugar.show', $data);
  }

  public function edit(Lugar $lugar)
  {
      //
  }

  public function update(Request $request, Lugar $lugar)
  {
    $item = Lugar::find($lugar->id);
    $rules = array(
      'nombre'            => 'required|max:140',
      'direccion'         => 'required',
      'localidad'         => 'required',
    );
    $validator = $this->validate($request, $rules);

    $item->update($request->all());

    $item->activo = 1;
    $item->usuario_id = $request->user()->id;

    if ($item->save()) {
      $request->session()->flash('status', 'Guardado!');
    }else{
      $request->session()->flash('status', 'No se pudo guardar. :(');
    }
      return redirect()->route('admin.lugar.index');
  }

  public function estado(Request $request, Lugar $lugar)
      {
        $item = Lugar::findOrFail($request->input('id'));
        if ($item) {
          if ($item->activo) {
            $estado = 0;
          }else{
            $estado = 1;
          }
          $item->activo = $estado;
          $item->save();
          $data['estado'] = $estado;
        }
        $data['estado'] = 'No encontre el item';

        return json_encode($data);

      }

  public function destroy(Lugar $lugar)
  {
      //
  }
}
