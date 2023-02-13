@extends('layouts.app')

@section('title', 'Pridėti naują viešbutį')

@section('content')

<div class="container col-md-7 mt-5">
    <div class="card">
        <div class='card-header'>
            <h5 class="card-title text-center">Naujo viešbučio kortelė</h5>
        </div>
        <form class="card-body" action='{{route('hotels-store')}}' method='post' enctype="multipart/form-data">

            <label class="form-label">Šalis</label>
            <select class="form-select form-select-lg mb-4" name='country'>
                <option selected></option>
                @foreach($countries as $value)
                <option value="{{$value->name}}">{{$value->name}}</option>
                @endforeach
            </select>
            <label class="form-label">Pavadinimas</label>
            <input required class="form-control form-control-lg mb-4" type="text" name="name">
            <div class='row'>
                <div class='col'>
                    <label class="form-label">Kelionės kaina</label>
                    <input required class="form-control form-control-lg mb-4" type="number" name="price">
                </div>
                <div class='col'>
                    <label class="form-label">Kelionės trukmė</label>
                    <input required class="form-control form-control-lg mb-4" type="number" name="trip_length">
                </div>
            </div>
            <label class="form-label">Nuotrauka</label>
            <input class="form-control form-control-lg mb-4" type="file" name="photo">
            <button type="submit" class="btn btn-outline-info">Sukurti</button>
            @csrf
        </form>
    </div>
</div>

@endsection
