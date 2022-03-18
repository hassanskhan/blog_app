@extends('layouts.app')

@section('content')
<div class="container" id="app">


    <user-post :userPost="{{$userPosts}}"></user-post>



</div>
@endsection