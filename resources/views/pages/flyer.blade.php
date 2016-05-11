@extends('layout')

@section('style')
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">
@stop

@section('content')
    <div class="row">
        <div class="col-xs-4">
            <h3>{{$flyer->street}}</h3>
            <h4>{{$flyer->price}}</h4>

            <hr>
            <div class="description">{!!$flyer->description!!}</div>
        </div>
        <div class="col-xs-8">
            <?php /*Refactor
            <div class="row">
            @foreach($flyer->photos as $photo)
                <img class="thumbnail col-xs-4" src="/{{ $photo->thumbnail_path }}" alt="">
            @endforeach
            </div>
            <?php Refactor */;?>
            @foreach($flyer->photos->chunk(4) as $set)
                <div class="row">
                    @foreach($set as $photo)
                        <div class="col-xs-3">
                            <img class="thumbnail" src="/{{ $photo->thumbnail_path }}" alt="">
                        </div>

                    @endforeach
                </div>
            @endforeach
            @if( isset($user) && $user->owns($flyer) )
                <form id="addPhotosForm" action="/{{$flyer->zip}}/{{$flyer->street}}/photos" class="dropzone" method="post">
                    {{ csrf_field() }}
                </form>
            @endif
        </div>
        <hr>
    </div>

@stop

@section('scripts.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
    <?php # add contraint to uploaded photos js side;?>
    <script>
        Dropzone.options.addPhotosForm = {
            paramName: 'photo',
            maxFilesize: 3.2, // set to 3mb
            acceptedFiles: '.jpg, .jpeg, .png, .bmp' // .jpg, .jpeg, .png,
        };
    </script>
@stop


