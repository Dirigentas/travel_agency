@extends('layouts.front')

@section('title', 'Kelionių agentūra')

@section('content')

<div class='container text-center row'>
    <div class='col-3'>
        @include('front.categories')
    </div>
    <div class='col-9'>
        <div class="card">
            <div class='card-header row'>
                <div class='col-6'>
                    <input type="text" class="form-control" placeholder="Ieškoti pagal pavadinimą">
                </div>
                <div class='col-6'>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Rūšiuoti</option>
                        <option value="low">Kaina nuo žemiausios</option>
                        <option value="high">Kaina nuo auksčiausios</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($hotels as $value)
            <div class="col-6 mt-5">
                <a href='{{route('show', $value)}}' class="btn btn-outline-primary">
                    <img class='img-fluid img-thumbnail' src='{{asset($value->photo)}}'>
                    <div> {{$value->country}}</div>
                    <div class='fw-bold col'> {{$value->name}}</div>
                    <div> {{$value->price}} Eur/naktį</div>
                    <div> {{$value->trip_length}} nakvynė(-s)(-ių)</div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>

@endsection
