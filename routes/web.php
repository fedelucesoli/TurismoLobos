<?php

Route::get('/', function () {
    return view('paginas/inicio');
});
Route::get('/ciudad', function () { return view('paginas/ciudad'); });
Route::get('/donde/comer', function () { return view('paginas/donde-comer'); });

Route::get('/donde/dormir', function () { return view('paginas/donde-dormir'); });

Route::get('/eventos', 'WebController@eventos');

Route::get('/contacto', function () { return view('paginas/contacto'); });
Route::get('/turismo/activo', function () { return view('paginas/turismo-activo'); });
Route::get('/turismo/laguna', function () { return view('paginas/turismo-laguna'); });
Route::get('/turismo/religioso', function () { return view('paginas/turismo-religioso'); });
Route::get('/turismo/reuniones', function () { return view('paginas/turismo-reuniones'); });
Route::get('/turismo/rural', function () { return view('paginas/turismo-rural'); });

Auth::routes();


Route::get('/admin', 'Admin\DashboardController@index')->name('admin');

Route::resource('admin/gastronomia', 'Admin\GastronomiaController', ['as' => 'admin']);
Route::resource('admin/eventos', 'Admin\EventoController', ['as' => 'admin']);
Route::resource('admin/alojamiento', 'Admin\AlojamientoController', ['as' => 'admin']);
Route::resource('admin/lugar', 'Admin\LugarController', ['as' => 'admin']);
Route::resource('admin/categorias', 'Admin\CategoriaController', ['as' => 'admin']);

Route::post('admin/image', 'Admin\ImageController@store')->name('admin');
