@extends('layouts.front')

@section('title', 'Kelionių agentūra')

@section('content')

<div class='container text-center row'>
    <div class='col-3'>
        @include('front.categories')
    </div>
    <div class='col-9'>
        <div class="card">
            <div class='card-header'>
                <h3 class='mb-3'>Išsirink svajonių kelionę</h3>
                <form class='row' @if(isset($country)) action="{{route('show-cats-hotels', $country)}}" @else action="{{route('index')}}" @endif method='get'>
                    <div class='col-4'>
                        <input name='s' type="text" class="form-control" placeholder="Ieškoti pagal pavadinimą" value="{{$s}}">
                    </div>
                    <div class='col-4'>
                        <select class="form-select" name='sort'>
                            <option value='all' selected>Rūšiuoti</option>
                            @foreach($sortSelect as $index => $value)
                            <option value="{{$index}}" @if($sortShow==$index) selected @endif>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="ms-3 col-1 btn btn-outline-primary">Rodyti</button>
                    <a href='{{route('index')}}' class='ms-3 col-1 btn btn-outline-warning'>Išvalyti</a>
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($hotels as $value)
            <div class="col-6 mt-5">
                <a href='{{route('show', $value)}}' class="btn btn-outline-primary">
                    @if($value->photo)
                    <img class='img-fluid img-thumbnail' src='{{asset($value->photo)}}'>
                    @else
                    <img class='img-fluid img-thumbnail' src='{{asset('no.jpg')}}'>
                    @endif
                    <div> {{$value->country}}</div>
                    <div class='fw-bold col'> {{$value->name}}</div>
                    <div> {{round($value->price, 0)}} Eur</div>
                    <div> {{$value->trip_length}} nakvynė(-s)(-ių)</div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
