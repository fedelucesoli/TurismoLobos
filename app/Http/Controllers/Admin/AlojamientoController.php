<?php

namespace App\Http\Controllers\Admin;

use App\Models\Alojamiento;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Logic\MapasRepository;
use App\Logic\ImageRepository;

class AlojamientoController extends Controller
{
    public function __construct(MapasRepository $MapaRepository, ImageRepository $imageRepository){

      $this->middleware('auth');
      $this->mapa = $MapaRepository;
      $this->imageRepository = $imageRepository;

    }
    public function index()
    {
      $data['alojamientos'] = Alojamiento::paginate(20);
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
      $item->categoria_id = $request->categoria;

      $item->direccion = $request->direccion;
      $item->localidad = $request->localidad;

      $item->telefono = $request->telefono;
      $item->web = $request->web;
      $item->email = $request->email;

      $item->lng = $request->lng;
      $item->lat = $request->lat;

      $item->activo = 0;
      $item->usuario_id = $request->user()->id;
      $item->save();

      if($request->hasFile('imagenes')){
          foreach ($request->imagenes as $photo) {
              $request['file'] = $photo;
              $request['id_item'] = $item->id;
              $data['response'] = $this->imageRepository->upload($request);
          }
      }

      return redirect()->route('admin.alojamiento.show', $item)->with('success', 'Alojamiento creado!');
    }

    public function show(Alojamiento $alojamiento)
    {
      $data['item'] = $alojamiento;
      $data['imagenes'] = $alojamiento->imagenes;

      $data['categorias'] = Categoria::where('parent', 'alojamientos')->get();

      $data['map'] = $this->mapa->showMarkerMap($data['item']);
      return view('admin.alojamiento.show', $data);

    }

    public function edit(Alojamiento $alojamiento)
    {
        $data['item'] = $alojamiento;
        $data['categorias'] = Categoria::where('parent', 'alojamientos')->get();

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
      $item->categoria_id = $request->categoria;

      $item->direccion = $request->direccion;
      $item->localidad = $request->localidad;

      $item->telefono = $request->telefono;
      $item->web = $request->web;
      $item->email = $request->email;

      $item->lng = $request->lng;
      $item->lat = $request->lat;

      // $item->estrellas = $request->estrellas;

      $item->usuario_id = $request->user()->id;
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
