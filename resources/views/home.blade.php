@extends('layouts.app')

@section('content')
<div class="container" id="app">
    
    <home :posts="{{$posts}}"></home>

</div>
@endsection
