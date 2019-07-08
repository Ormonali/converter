@extends('layouts.layout')
@section('content')
    <div class="jumbotron ">
    <h1>Online converter</h1>
    <form action="/download" method="POST" >
        <div class="input-group mb-3">
        @csrf
        <input type="text" class="form-control" name="url" placeholder="url: ">
            <div class="input-group-append">
                    <select class="custom-select" name="format">
                        <option>.mp3</option>
                        <option>.mp4</option>
                    </select>
                <button class="btn btn-outline-success" type="submit">START</button> 
            </div>
        </div>
        </form>  
    </div>

@endsection


