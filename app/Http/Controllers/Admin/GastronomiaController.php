<?php

namespace App\Http\Controllers\Admin;


use App\Models\Gastronomia;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Logic\MapasRepository;

class GastronomiaController extends Controller
{
    public function __construct(MapasRepository $MapaRepository){

      $this->middleware('auth');
      $this->mapa = $MapaRepository;

    }

    public function index()
    {
      $data['gastronomia'] = Gastronomia::all();
      $data['categorias'] = Categoria::where('parent', 'gastronomia')->get();

      return view('admin.gastronomia.index', $data);
    }

    public function create()
    {
      $data['local'] = new Gastronomia;
      $data['map'] = $this->mapa->addMarkerMap();
      $data['categorias'] = Categoria::where('parent', 'gastronomia')->get();
      return view('admin.gastronomia.form', $data);
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

        $item = new Gastronomia;
        $item->nombre = $request->nombre;
        $item->direccion = $request->direccion;
        $item->localidad = $request->localidad;
        $item->telefono = $request->telefono;
        $item->web = $request->web;
        $item->email = $request->email;
        $item->lng = $request->lng;
        $item->lat = $request->lat;
        $item->categoria_id = $request->categoria;
        $item->estrellas = $request->estrellas;
        $item->horarios = $request->horarios;

        $item->activo = 0;
        $item->usuario_id = $request->user()->id;
        $item->save();

        if ($item->save()) {
          $request->session()->flash('status', 'Creado!');
        }else{
          $request->session()->flash('status', 'No se pudo crear!');
        }
          return redirect()->route('admin.gastronomia.index');
    }


    public function show($id)
    {
      $data['item'] = Gastronomia::find($id);
      $data['categorias'] = Categoria::where('parent', 'gastronomia')->get();

        if(is_null($data['item'])){
          $request->session()->flash('status', ':( No se encuentra ese registro!');
          return redirect()->route('admin.comer.index');
        }
        $data['map'] = $this->mapa->showMarkerMap($data['item']);
        return view('admin.gastronomia.show', $data);
    }


    public function edit($gastronomia)
    {
      $data['item'] = Gastronomia::find($gastronomia);
      $data['categorias'] = Categoria::where('parent', 'gastronomia')->get();

      $data['map'] = $this->mapa->showMarkerMap($data['item']);

      return view('admin.gastronomia.show', $data);
    }


    public function update(Request $request, $id)
    {
      $item = Gastronomia::find($id);
      if ($request->formActivar) {
        $item->activo = $request->activo;
        $item->save();
        return redirect()->route('admin.gastronomia.show', $id)->with('success', 'Item actualizado');
      }

      $rules = array(
        'nombre'            => 'required|max:140',
        'direccion'         => 'required',
        'localidad'         => 'required',
        'categoria'         => 'required',
      );
      $validator = $this->validate($request, $rules);

      $item->nombre = $request->nombre;
      $item->direccion = $request->direccion;
      $item->localidad = $request->localidad;
      $item->telefono = $request->telefono;
      $item->web = $request->web;
      $item->email = $request->email;
      $item->lng = $request->lng;
      $item->lat = $request->lat;
      $item->categoria_id = $request->categoria;
      $item->estrellas = $request->estrellas;
      $item->horarios = $request->horarios;

      $item->usuario_id = $request->user()->id;
      $item->save();

      return redirect()->route('admin.gastronomia.show', $id)->with('success', 'Item actualizado');

    }

    public function destroy($id)
    {
      $gastronomia = Gastronomia::find($id);

      if ($gastronomia) {
        $gastronomia->delete();
        return redirect()->route('admin.gastronomia.index')->with('success', 'Registro eliminado!');
      }else{
        return redirect()->route('admin.gastronomia.index')->with('error', 'No se pudo eliminar el registro!');
      }
    }
}
