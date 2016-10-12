@extends('layouts.base')

@section('content')

    <h1>
        Album <strong> {{ $album->name }} </strong>
    </h1>

    @foreach($album->images as $image)

        <div class="col-xs-6 thumbnail">

            <img src="{{ $image->image_url }}" alt="{{ $image->alt }}"/>

            <div>
                <a href="{{ route('images_update', ['id' => $image->id]) }}"
                   class="btn btn-link pull-left">
                    Edytuj
                </a>

                {{ Form::open([
                    'route' => ['images_delete', $image->id],
                    'method' => 'delete',
                    'onsubmit' => 'return confirmDelete()',]) }}
                <button class="btn btn-link pull-left" type="submit">Usuń</button>
                {{ Form::close() }}

            </div>

        </div>

    @endforeach

@endsection