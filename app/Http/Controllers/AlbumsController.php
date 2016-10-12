<?php


namespace App\Http\Controllers;

use App\Http\Requests\StoreAlbum;
use App\Http\Requests\DeleteAlbum;
use App\Album;
use Kris\LaravelFormBuilder\FormBuilder;

class AlbumsController extends Controller
{
    public function index()
    {
        return view('albums/index', ['albums' => Album::all()]);
    }

    public function update(FormBuilder $formBuilder, $id)
    {
        $album = Album::findOrFail($id);
        $form = $formBuilder->create(\App\Forms\AlbumForm::class, [
            'method' => 'POST',
            'url' => route('albums_edit'),
            'model' => $album,
        ]);

        return view('albums/update', compact('form'));
    }

    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(\App\Forms\AlbumForm::class, [
            'method' => 'POST',
            'url' => route('albums_store')
        ]);

        return view('albums/create', compact('form'));
    }

    public function edit(StoreAlbum $request)
    {
        try {
            $data = $request->all();
            $album = Album::findOrFail($data['id']);
            $album->fill($data);
            $album->save();

            flash($this->putFlashMsg('update'));
            return redirect()->route('albums_index');
        } catch (\Exception $e) {
            flash('Wystąpił nieoczekiwany błąd!', 'danger');
            return redirect()->route('albums_index');
        }
    }

    public function store(StoreAlbum $request)
    {
        try {
            Album::create($request->all());
            flash($this->putFlashMsg('create'));
            return redirect()->route('albums_index');
        } catch (\Exception $e) {
            flash('Wystąpił nieoczekiwany błąd!', 'danger');
            return redirect()->route('albums_index');
        }
    }

    public function delete(DeleteAlbum $request, $id)
    {
        try {
            $album = Album::findOrFail($id);
            $album->delete();   
            flash($this->putFlashMsg('delete'));
            return redirect()->route('albums_index');
        } catch (\Exception $e) {
            flash('Wystąpił nieoczekiwany błąd!', 'danger');
            return redirect()->route('albums_index');
        }
    }

    protected function putFlashMsg($scope)
    {
        switch ($scope):
            case 'create':
                // jak wiele jęz to trans lub jakieś inne
                return 'Dobra robota. Album został utworzony!';
            case 'update':
                return 'Zmiany zostały zapisane!';
            case 'delete':
                return 'Album oraz zdjęcia w albumie zostały usunięte!';
            default:
                return 'Operacja poprawnie wykonana';
        endswitch;
    }

}