@extends('layouts.layout')
@section('content')
    <div class="jumbotron">
     <div class="media">
        <img class="align-self-center mr-3" src="{{$getInfo['thumbnail']}}" alt="{{$getInfo['title']}}" width="200" height="120">
            <div class="media-body">
                <p>{{$getInfo['title']}} </p>
                <p>Размер: {{$getInfo['size']}}, скачать в формате {{$getInfo['format']}}</p>
                <a class="btn btn-primary" href="../converted/{{$getInfo['name']}}" download>скачать</a>
            </div>
        </div>
    </div>
@endsection