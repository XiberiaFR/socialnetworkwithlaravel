@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card">
                <div class="card-header">{{ __('Bonjour') }} {{$user->prenom}} {{$user->nom}}</div>
                <div class="card-body">
                <p>{{ __('Votre pomgoname :') }} {{$user->pomgoname}}</p>
                <p>{{ __('Votre email :') }} {{$user->email}}</p>
                <p>{{ __('Votre mot de passe : •••••••••••') }}</p>
                </div>

            </div>
            <a href="{{ route('user.edit', $user) }}" class="mt-3 btn btn-primary">
            {{ __('Modifier mes informations') }}
            </a>
        </div>
    </div>
    @endsection