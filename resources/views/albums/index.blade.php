@extends('layouts.base')

@section('content')

    <h1>
        Albumy
    </h1>

    <div class="row">

    @foreach($albums as $album)

        <div class="col-xs-12">

            <a href="{{ route('images_index', ['id'=>$album->id]) }}"
            class="btn btn-link pull-left">
                {{ $album->name }}
                ({{ $album->images_count }})
            </a>

            <a href="{{ route('albums_update', ['id' => $album->id]) }}"
            class="btn btn-link pull-left">
                Edytuj
            </a>

            {{ Form::open([
                'route' => ['albums_delete', $album->id],
                'method' => 'delete',
                'onsubmit' => 'return confirmDelete()',]) }}
                <button
                        class="btn btn-link pull-left"
                        type="submit">Usuń</button>
            {{ Form::close() }}

        </div>

    @endforeach


    </div>


@endsection