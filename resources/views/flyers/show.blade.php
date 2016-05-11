@extends('layout')
@section('content')
    <h1>{!! $flyer->street !!}</h1>
    <hr>
    <h2>Price {!! $flyer->price !!}</h2>
    <div class="description">{!! nl2br($flyer->description) !!} </div>
@end