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
                @if($hotel->photo)
                <img class='card-img-top' src='{{asset($hotel->photo)}}'>
                @else
                <img class='card-img-top' src='{{asset('no.jpg')}}'>
                @endif
                <div class="card-body row">
                    <h4 class='card-title col-6'> {{$hotel->country}}</h4>
                    <div class='col-6'> {{$hotel->price}} Eur</div>
                    <h4 class='col-6'> {{$hotel->name}}</h4>
                    <div class='col-6'> {{$hotel->trip_length}} nakvynė(-s)(-ių)</div>
                    @if(isset($user))
                    <form class='mt-3' action="{{route('add-to-cart')}}" method="post">
                        <label>Asmenų skaičius: </label>
                        <input type="number" min="1" name="count" value="2">
                        <input type="hidden" name="hotel" value="{{$hotel->id}}">
                        <button type="submit" class="col-12 mt-3 btn btn-outline-primary">Rezervuoti</button>
                        @csrf
                    </form>
                    @else
                    <a href='{{route('home')}}' class="col-12 mt-3 btn btn-outline-primary">Rezervuoti (reikalingas prisijungimas)</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
