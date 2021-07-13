@extends('layouts.app')

@section('content')

<form enctype="multipart/form-data" class="m-1 d-flex align-items-center mb-3" method="POST" action="{{ route('comment.update', $comment) }}">
    @csrf
    @method('PUT')
    <input name="pomgo-id-comment" type="hidden" value="{{ $comment->pomgo_id }}">
    <textarea name="comment-content" class="ml-1 col-md-8" type="text" placeholder="Ecrivez votre commentaire">{{ $comment->content }}</textarea>
    <div class="col-md-4 m-2">
    <img src="{{ asset('images') }}/{{ $comment->image }}" class="img-thumbnail" alt="">
        <input type="file" name="image_comment" class="mb-2 form-control">
        <button class=" btn btn-success" type="submit">Publier</button>
    </div>
</form>

@endsection