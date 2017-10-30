<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str as Str;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    public function __construct(){

      $this->middleware('auth');

    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    public function store(Request $request)
    {
      if ($request->_method === 'PUT') {
        $item = Categoria::find($request->id);
        $item->nombre = $request->nombre;
        $item->parent = $request->parent;
        $item->slug = Str::slug($request->nombre);
        $item->save;
        return response()->json([
          'nombre' => $item->nombre,
          'slug' => Str::slug($item->nombre),
          'parent' => $item->parent,
          'id' => $item->id,
        ], 200);
      }
      $item = new Categoria;
      $item->nombre = $request->nombre;
      $item->parent = $request->parent;
      $item->slug = Str::slug($request->nombre);
      $item->usuario_id = $request->user()->id;
      if ($item->save()) {
        return response()->json([
          'nombre' => $item->nombre,
          'slug' => Str::slug($item->nombre),
          'parent' => $item->parent,
          'id' => $item->id,
        ], 200);
      }else{
        return response()->json([
          'nombre' => $request->nombre,
          'parent' => $request->parent,
        ], 500);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $categoria = Categoria::find($id);
      $categoria->delete();

      if ($categoria) {
        $categoria->delete();

        return response()->json([
          'mensaje' => "Eliminado",
        ], 200);
      }else{

        return response()->json([
          'mensaje' => "No se pudo eliminar!",
        ], 500);
      }
    }
}
