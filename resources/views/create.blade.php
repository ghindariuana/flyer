@extends('layout')

@section('content')
    <h1>Selling your home?</h1>
    <hr>
    <div class="row">
        <form enctype="multipart/form-data" method="post" action='/flyers' class="col-md-6">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}} </li>
                    @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <label for="street">Street:</label>
                <input type="text" name="street" id="street" class="form-control" value="{{old('street')}}" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" name="city" id="city" class="form-control" value="{{old('city')}}" required>
            </div>
            <div class="form-group">
                <label for="zip">Zip/Postal code:</label>
                <input type="text" name="zip" id="zip" class="form-control" value="{{old('zip')}}" required>
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <select id="country" name="country" class="form-control" value="{{old('country')}}" required>
                    <option value="">Select</option>
                    @foreach(App\Http\Utilities\Country::all() as $country => $code)
                        <option value="{{$code}}">{{$country}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" name="state" id="state" class="form-control" value="{{old('state')}}" required>
            </div>

            <hr>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" name="price" id="price" class="form-control" value="{{old('price')}}" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea rows="10"   name="description" id="description" class="form-control" value="{{old('description')}}" required>
                </textarea>
            </div>
            <div class="form-field">
                <label for="photos">Photos:</label>
                <input type="file" name="photos" id="photos" class="form-control">
            </div>
            <br/>
            <div class="form-group">
                <input type="submit"  class="btn btn-primary" value="Create Flyer">
            </div>
        </form>
    </div>
@stop