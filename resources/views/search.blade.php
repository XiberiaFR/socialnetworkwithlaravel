@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

            <h1 class="my-4">Résultats de votre recherche pour:
                <small>{{$recherche}}</small>
            </h1>

            <div class="pomgos">
                <div class="row justify-content-center" id="pomgos">
                    @foreach($pomgos as $pomgo)
                    <div class="pomgo col-md-5 d-flex flex-column shadow m-3 bg-body rounded text-center">
                        @if(Auth::user()->id == $pomgo->user_id)
                        <a class="m-3 btn btn-info" href="{{ route('pomgo.edit', $pomgo) }}">Modifier le pomgo</a>
                        @endif
                        <img src="{{ asset('images') }}/{{ $pomgo->image }}" class="img-thumbnail" alt="">
                        <p>{{ $pomgo->content }}</p>
                        <p>Tags: {{ $pomgo->tags }}</p>
                        <p>Pomgo ajouté par {{$pomgo->user->pomgoname}} - {{ $pomgo->created_at }} </p>

                        <div class="shadow m-1 rounded">
                            @foreach($pomgo->comments as $comment)
                            <div class="shadow rounded">
                                <p>{{$comment->content}}</p>
                                <p>{{$comment->username}}</p>
                                <p class="text-right">{{$comment->user->pomgoname}} le {{$comment->created_at}}</p>
                                @if(Auth::user()->id == $comment->user_id || Auth::user()->id == $pomgo->user_id)
                                <a class="col-md-5 mb-3 btn btn-info h5" href="{{ route('comment.edit', $comment) }}">Modifier le commentaire</a>

                                <form method="POST" action="{{ route('comment.destroy', $comment) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="col-md-5 mb-1 btn btn-danger" type="submit">Supprimer le commentaire</button>
                                </form>

                                @endif
                            </div>
                            @endforeach

                            <form enctype="multipart/form-data" class="m-1 d-flex align-items-center mb-3" method="POST" action="{{ route('comment.store') }}">
                                @csrf
                                <input name="pomgo-id-comment" type="hidden" value="{{ $pomgo->id }}">
                                <textarea name="comment-content" class="ml-1 col-md-8" type="text" placeholder="Ecrivez votre commentaire"></textarea>
                                <div class="col-md-4 m-2">
                                    <input type="file" name="image_comment" class="mb-2 form-control">
                                    <button class=" btn btn-success" type="submit">Publier</button>
                                </div>
                            </form>
                        </div>

                    </div>
                    @endforeach
            </div>
        </div>
        @endsection