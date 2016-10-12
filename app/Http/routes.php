<?php


Route::get('/', [
    'as' => 'albums_index',
    'uses' => '\App\Http\Controllers\AlbumsController@index'
]);
Route::get('/album/{id}', [
    'as' => 'images_index',
    'uses' => '\App\Http\Controllers\ImagesController@index'
])->where('id', '[0-9]+');;

Route::get('/album/nowy', [
    'as' => 'albums_create',
    'uses' => '\App\Http\Controllers\AlbumsController@create'
]);

Route::get('/album/edycja/{id}', [
    'as' => 'albums_update',
    'uses' => '\App\Http\Controllers\AlbumsController@update'
])->where('id', '[0-9]+');;

Route::get('/zdjecie/edycja/{id}', [
    'as' => 'images_update',
    'uses' => '\App\Http\Controllers\ImagesController@update'
])->where('id', '[0-9]+');;

Route::get('/zdjecie/nowe', [
    'as' => 'images_create',
    'uses' => '\App\Http\Controllers\ImagesController@create'
]);

Route::post('/album/zapisz', [
    'as' => 'albums_store',
    'uses' => '\App\Http\Controllers\AlbumsController@store'
]);

Route::post('/zdjecie/zapisz', [
    'as' => 'images_store',
    'uses' => '\App\Http\Controllers\ImagesController@store'
]);

Route::post('/zdjecie/edytuj', [
    'as' => 'images_edit',
    'uses' => '\App\Http\Controllers\ImagesController@edit'
]);

Route::post('/album/edytuj', [
    'as' => 'albums_edit',
    'uses' => '\App\Http\Controllers\AlbumsController@edit'
]);

Route::delete('/album/usun/{id}', [
    'as' => 'albums_delete',
    'uses' => '\App\Http\Controllers\AlbumsController@delete'
])->where('id', '[0-9]+');;

Route::delete('/zdjecie/usun/{id}', [
    'as' => 'images_delete',
    'uses' => '\App\Http\Controllers\ImagesController@delete'
])->where('id', '[0-9]+');;
