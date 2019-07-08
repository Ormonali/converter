@extends('layouts.layout')
@section('content')
    <img src="{{$getInfo['thumbnail']}}" alt="{{$getInfo['title']}}" width="200" height="120">
    <p>{{$getInfo['title']}} скачать в формате {{$getInfo['format']}}</p>
    <a href="../converted/{{$getInfo['name']}}" download>скачать</a>
@endsection