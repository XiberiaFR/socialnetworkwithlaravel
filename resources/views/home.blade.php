@extends('layouts.app')

@section('content')
<div class="container-fluid bg-image d-flex justify-content-center align-items-center flex-column">
    <div class="row mb-5">
        <h1 class="h1 text-primary bg-white col-md-12 rounded">Pomgo, le réseau social du moment</h1>
    </div>
    <div class="row mt-5">
        <div class="col-md-12 panel-group text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <!-- Editing the HREF from original -->
                        <button class="col-md-12 btn btn-primary" data-toggle="collapse" href="#collapse">Publier un Pomgo</button>
                    </h4>
                </div>
                @if(!empty(session('image')))
                <div id="collapse" class="panel-collapse collapse show">
                    @else
                    <div id="collapse" class="panel-collapse collapse">
                        @endif

                        @if(empty(session('image')))
                        <form class="shadow m-3 bg-body rounded" action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <input type="file" name="image" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success">Je valide l'image</button>
                                </div>

                            </div>
                        </form>
                        @endif

                        <form class="shadow p-3 bg-body rounded bg-opacity" method="POST" action="{{ route('pomgo.store') }}">
                            @csrf
                            <div class="">
                                <input type="text" class="m-2 form-control" id="pomgo_text" name="pomgo_text" placeholder="Quoi de neuf ?">
                                <input type="text" class="m-2 form-control col-md-4" id="pomgo_tags" name="pomgo_tags" placeholder="Écrivez vos pomgotags">
                                <div class="imgcontainer">
                                    @if (session('image'))
                                    <input type="hidden" class="m-2 form-control" id="pomgo_img" name="pomgo_img" readonly="readonly" value="{{ session('image') }}">
                                    <img src="{{ asset('images') }}/{{ session('image') }}" alt="pomgoimage" class="img-thumbnail col-md-3">
                                    @else
                                    <input type="text" class="m-2 form-control" id="pomgo_img" name="pomgo_img" readonly="readonly" placeholder="Merci de télécharger votre image ci-dessus">
                                    @endif
                                </div>

                                <button class="m-2 btn btn-success" type="submit">Je valide mon pomgo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <a class="col-md-12 btn btn-primary" href="#pomgos">Découvrir les pomgos</a>
        </div>
    </div>

    <div class="pomgos container">
        <div class="row justify-content-center" id="pomgos">
            @foreach($pomgos as $pomgo)
            <div class="pomgo col-md-12 d-flex flex-column shadow m-3 bg-body rounded text-center">
                @if(Auth::user()->id == $pomgo->user_id)
                <a class="m-3 btn btn-danger" href="{{ route('pomgo.edit', $pomgo) }}">Modifier</a>
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
                        @if(Auth::user()->id == $comment->user_id)
                        <a class="col-md-5 mb-3 btn btn-danger" href="{{ route('comment.edit', $comment) }}">Modifier</a>

                        <form method="POST" action="{{ route('comment.destroy', $comment) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="col-md-5 mb-1 btn btn-danger" type="submit">Supprimer</button>
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