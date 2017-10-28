<?php

namespace App\Http\Controllers\Admin;

use App\Models\Evento;
use App\Models\Categoria;
use App\Models\Lugar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventoController extends Controller
{
    public function __construct(){

      $this->middleware('auth');

    }

    public function index()
    {
        $data['eventos'] = Evento::all();
        $data['categorias'] = Categoria::where('parent', 'eventos')->get();
        return view('admin.eventos.index', $data);
    }

    public function create()
    {
      $data['item'] = new Evento;
      $data['lugares'] = Lugar::all();
      // TODO - Where para eventos
      $data['categorias'] = Categoria::where('parent', 'eventos')->get();
      return view('admin.eventos.form', $data);


    }

    public function store(Request $request)
    {
      $rules = array(
        'titulo'            => 'required|max:140',
        'categoria'         => 'required',
        'fecha'             => 'required',
        'hora'              => 'required',
      );
      $validator = $this->validate($request, $rules);
      $item = new Evento;
      $item->titulo = $request->titulo;
      $item->slug = str_slug($request->titulo, '-');
      $item->descripcion = $request->descripcion;
      $item->fecha = $request->fecha;
      $item->hora = $request->hora;
      $item->categoria = $request->categoria;

      $item->lugar_id = $request->lugar;

      // $item->badge = $request->badge;
      // $item->superevento = $request->superevento;
      // $item->subevento = $request->subevento;
      // $item->order_column = $request->order_column;
      // $item->fecha_fin = $request->fecha_fin;
      $item->activo = 0;
      $item->usuario_id = $request->user()->id;
      $item->save();
      return redirect()->route('admin.eventos.show', $item)->with('success', 'Evento creado!');

    }

    public function show(Evento $evento)
    {
      $data['item'] = $evento;
      $data['lugares'] = Lugar::all();
      
      $data['lugar'] = Lugar::find($evento->lugar_id);
      $data['categorias'] = Categoria::where('parent', 'eventos')->get();

      return view('admin.eventos.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $evento)
    {
        //
    }
}
