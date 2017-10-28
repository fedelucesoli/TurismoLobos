<?php

namespace App\Http\Controllers\Admin;

use App\Models\Alojamiento;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Logic\MapasRepository;

class AlojamientoController extends Controller
{
    public function __construct(MapasRepository $MapaRepository){

      $this->middleware('auth');
      $this->mapa = $MapaRepository;

    }
    public function index()
    {
      $data['alojamientos'] = Alojamiento::all();
      $data['categorias'] = Categoria::where('parent', 'alojamientos')->get();

      return view('admin.alojamiento.index', $data);
    }


    public function create()
    {
      $data['item'] = new Alojamiento;
      $data['map'] = $this->mapa->addMarkerMap();
      $data['categorias'] = Categoria::where('parent', 'alojamientos')->get();

      return view('admin.alojamiento.form', $data);
    }


    public function store(Request $request)
    {
      $rules = array(
        'nombre'            => 'required|max:140',
        'direccion'         => 'required',
        'localidad'         => 'required',
        'categoria'         => 'required',
      );
      $validator = $this->validate($request, $rules);

      $item = new Alojamiento;
      $item->nombre = $request->nombre;
      $item->categoria = $request->categoria;

      $item->direccion = $request->direccion;
      $item->localidad = $request->localidad;

      $item->telefono = $request->telefono;
      $item->web = $request->web;
      $item->email = $request->email;

      $item->lng = $request->lng;
      $item->lat = $request->lat;

      $item->activo = 0;
      $item->id_usuario = $request->user()->id;
      $item->save();
      return redirect()->route('admin.alojamiento.show', $item)->with('success', 'Alojamiento creado!');
    }

    public function show(Alojamiento $alojamiento)
    {
      $data['item'] = $alojamiento;
      $data['map'] = $this->mapa->showMarkerMap($data['item']);
      return view('admin.alojamiento.show', $data);

    }

    public function edit(Alojamiento $alojamiento)
    {
        $data['item'] = $alojamiento;
        $data['map'] = $this->mapa->showMarkerMap($data['item']);

        return view('admin.alojamiento.show', $data);

    }

    public function update(Request $request, Alojamiento $alojamiento)
    {
      $item = $alojamiento;
      if ($request->formActivar) {
        $item->activo = $request->activo;
        $item->save();
        return redirect()->route('admin.alojamiento.show', $alojamiento)->with('success', 'Alojamiento actualizado');
      }

      $rules = array(
        'nombre'            => 'required|max:140',
        'direccion'         => 'required',
        'localidad'         => 'required',
        'categoria'         => 'required',
      );
      $validator = $this->validate($request, $rules);

      $item->nombre = $request->nombre;
      $item->categoria = $request->categoria;

      $item->direccion = $request->direccion;
      $item->localidad = $request->localidad;

      $item->telefono = $request->telefono;
      $item->web = $request->web;
      $item->email = $request->email;

      $item->lng = $request->lng;
      $item->lat = $request->lat;

      // $item->estrellas = $request->estrellas;

      $item->id_usuario = $request->user()->id;
      $item->save();

      return redirect()->route('admin.alojamiento.show', $alojamiento)->with('success', 'Alojamiento actualizado');

    }

    public function destroy($id)
    {
        $alojamiento = Alojamiento::find($id);
        $alojamiento->delete();

        if ($alojamiento) {
          $alojamiento->delete();
          return redirect()->route('admin.alojamiento.index')->with('error', 'Alojamiento eliminado!');
        }else{
          return redirect()->route('admin.alojamiento.index')->with('error', 'No se pudo eliminar el alojamiento!');
        }
    }
}
