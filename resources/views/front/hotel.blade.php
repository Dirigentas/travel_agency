@extends('layouts.front')

@section('title', 'Kelionė')

@section('content')

<div class='container text-center row'>
    <div class='col-3'>
        @include('front.categories')
    </div>
    <div class='col-9'>
        <div class="card">
            <div class="">
                <img class='card-img-top' src='{{asset($hotel->photo)}}'>
                <div class="card-body">
                    <h4 class='card-title'> {{$hotel->country}}</h4>
                    <h4> {{$hotel->name}}</h4>
                    <div class='mt-3'> {{$hotel->price}} Eur/naktį</div>
                    <div class='mt-3'> {{$hotel->trip_length}} nakvynė(-s)(-ių)</div>
                    <a href="#" class="mt-3 btn btn-primary">Rezervuoti</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
