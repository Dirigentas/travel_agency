@extends('layouts.app')

@section('title', 'Redaguoti viešbutį')

@section('content')

<div class="container col-md-7 mt-5">
    <div class="card">
        <div class='card-header'>
            <h5 class="card-title text-center">Viešbučio kortelės redagavimas</h5>
        </div>
        <form class="card-body" action='{{route('hotels-update', $hotel)}}' method='post'>
            <label for="exampleInputEmail1" class="form-label">Šalis</label>
            <select class="form-select form-select-lg mb-4" aria-label="Default select example" name='country'>
                @foreach($countries as $value)
                <option @if($hotel->country == $value->name) selected @endif value="{{$value->name}}">{{$value->name}}</option>
                @endforeach
            </select>
            <label for="exampleInputEmail1" class="form-label">Pavadinimas</label>
            <input class="form-control form-control-lg mb-4" type="text" name="name" value='{{$hotel->name}}'>
            <div class='row'>
                <div class='col'>
                    <label for="exampleInputEmail1" class="form-label">Kaina už nakvynę</label>
                    <input class="form-control form-control-lg mb-4" type="number" name="price" value='{{$hotel->price}}'>
                </div>
                <div class='col'>
                    <label for="exampleInputEmail1" class="form-label">Kelionės trukmė</label>
                    <input class="form-control form-control-lg mb-4" type="number" name="trip_length" value='{{$hotel->trip_length}}'>
                </div>
            </div>
            <label for="exampleInputEmail1" class="form-label">Nuotrauka</label>
            <input class="form-control form-control-lg mb-4" type="file" name="photo">
            <button type="submit" class="btn btn-outline-info">Sukurti</button>
            @csrf
            @method('put')
        </form>
    </div>
</div>

@endsection
