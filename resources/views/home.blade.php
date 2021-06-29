@extends('layouts.app')

@section('content')
<div class="panel-body" id="list-1" v-infinite-scroll="loadMore" infinite-scroll-disabled="busy" infinite-scroll-distance="10">
   <example-component :message="message"></example-component>
</div>
@endsection
