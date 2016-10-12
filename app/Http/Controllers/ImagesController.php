<?php


namespace App\Http\Controllers;

use App\Http\Requests\DeleteImage;
use App\Http\Requests\StoreImage;
use App\Image;
use App\Album;
use Kris\LaravelFormBuilder\FormBuilder;

class ImagesController extends Controller
{
    public function index($id)
    {
        return view('images/index', ['album' => Album::findOrFail($id)]);
    }

    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(\App\Forms\ImageForm::class, [
            'method' => 'POST',
            'url' => route('images_store'),
        ]);

        return view('images/create', compact('form'));
    }

    public function store(StoreImage $request)
    {
        try {
            $image = Image::create($request->all());
            flash($this->putFlashMsg('create'));
            return redirect()->route('images_index', ['id' => $image->album_id]);
        } catch (\Exception $e) {
            flash('Wystąpił nieoczekiwany błąd!', 'danger');
            return redirect()->route('albums_index');
        }

    }

    public function update(FormBuilder $formBuilder, $id)
    {
        $image = Image::findOrFail($id);
        $form = $formBuilder->create(\App\Forms\ImageForm::class, [
            'method' => 'POST',
            'url' => route('images_edit'),
            'model' => $image,
        ]);

        return view('albums/update', compact('form'));
    }

    public function edit(StoreImage $request)
    {
        try {
            $data = $request->all();
            $image = Image::findOrFail($data['id']);
            $image->fill($data);
            $image->save();

            flash($this->putFlashMsg('update'));
            return redirect()->route('images_index', ['id' => $image->album_id]);
        } catch (\Exception $e) {
            flash('Wystąpił nieoczekiwany błąd!', 'danger');
            return redirect()->route('albums_index');
        }
    }

    public function delete(DeleteImage $request, $id)
    {
        try {
            $image = Image::findOrFail($id);
            $albumId = $image->album_id;
            $image->delete();
            flash($this->putFlashMsg('delete'));
            return redirect()->route('images_index', ['id'=>$albumId]);
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
                return 'Dobra robota. Zdjęcie zostało utworzone!';
            case 'update':
                return 'Zmiany zostały zapisane!';
            case 'delete':
                return 'Zdjęcie zostało usunięte!';
            default:
                return 'Operacja poprawnie wykonana';
        endswitch;
    }

}