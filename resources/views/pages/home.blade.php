@extends('layout')

@section('content')
    <div class="jumbotron">
        <h1>Project Flayer</h1>
        <p>This is a template showcasing the optional theme stylesheet included in Bootstrap. Use it as a starting point to create something more unique by building on or modifying it.
        </p>
        <a href="/flyers/create" class="btn btn-primary">Create a Flyer</a>
    </div>
    <div class="content">
        <h3>List of flyers</h3>
        <ul>
        @foreach($flyers as $flyer)
            <li><a href="/{{$flyer->zip}}/{{str_replace(' ', '-', $flyer->street)}}">{{$flyer->street}}</a></li>
        @endforeach
        </ul>
    </div>

@stop

