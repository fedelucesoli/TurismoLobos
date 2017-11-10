<?php

namespace App\Http\Controllers\Admin;


use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Logic\ImageRepository;

class ImageController extends Controller{

  public function __construct(ImageRepository $imagerepository){

    $this->middleware('auth');
    $this->image = $imagerepository;
  }

    public function store(Request $request)
    {
      
      return response()->json([
        'name' => '$request->name,',
        'state' => 'CA'
      ]);
    }


    public function show(Image $image)
    {
        //
    }

    public function edit(Image $image)
    {
        //
    }

    public function update(Request $request, Image $image)
    {
        //
    }


    public function destroy(Image $image)
    {
        //
    }
}
