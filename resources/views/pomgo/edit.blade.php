@extends('layouts.app')

@section('content')

<div class="container">
    <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">

        @csrf
        <div class="row">

            <div class="col-md-6">
                @if (session('image'))
                <img src="{{ asset('images') }}/{{ session('image') }}" class="img-thumbnail" alt="">
                @else
                <img src="{{ asset('images') }}/{{ $pomgo->image }}" class="img-thumbnail" alt="">
                @endif
                <input type="file" name="image" class="form-control">
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success">Enregistrer l'image</button>
            </div>
        </div>
    </form>

    <form method="POST" action="{{ route('pomgo.update', $pomgo) }}">
        @csrf
        @method('PUT')
        <div class="justify-content-center">
            <input type="text" class="form-control" id="pomgo_text" name="pomgo_text" value="{{ $pomgo->content }}">
            <input type="text" class="form-control col-md-4" id="pomgo_tags" name="pomgo_tags" value="{{ $pomgo->tags }}">

            @if (session('image'))
            <input type="hidden" class="form-control" id="pomgo_img" name="pomgo_img" readonly="readonly" value="{{ session('image') }}">
            @endif

            <button class="btn btn-primary" type="submit">Je pomgo</button>
        </div>
    </form>
</div>
@endsection