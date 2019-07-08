@extends('layouts.layout')
@section('content')
    <form action="/download" method="POST" >
      @csrf
        URL:<input type="text" name="url" width="300px">
        <select name="format">
            <option>.mp3</option>
            <option>.mp4</option>
        </select>
        <button type="submit">START</button>

    </form>  
@endsection


