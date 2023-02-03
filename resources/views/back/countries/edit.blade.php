@extends('layouts.app')

@section('title', 'Redaguoti šalį')

@section('content')

<div class="container col-md-7 mt-5">
    <div class="card">
        <div class='card-header'>
            <h5 class="card-title text-center">Šalies kortelės redagavimas</h5>
        </div>
        <form class="card-body" action='{{route('countries-update', $country)}}' method='post'>
            <label for="exampleInputEmail1" class="form-label">Pavadinimas</label>
            <input class="form-control form-control-lg mb-4" type="text" name="country" value='{{$country->country}}'>
            <label for="exampleInputEmail1" class="form-label">Sezono pradžios data</label>
            <input class="form-control form-control-lg mb-4" type="date" name="season_start" value='{{$country->season_start}}'>
            <label for="exampleInputEmail1" class="form-label">Sezono pabaigos data</label>
            <input class="form-control form-control-lg mb-4" type="date" name="season_end" value='{{$country->season_end}}'>
            <button type="submit" class="btn btn-outline-info">Išsaugoti</button>
            @method('put')
            @csrf
        </form>
    </div>
</div>

@endsection
