@extends('layouts.app')

@section('title', 'Pridėti naują šalį')

@section('content')

<div class="container col-md-7 mt-5">
    <div class="card">
        <div class='card-header'>
            <h5 class="card-title text-center">Naujos šalies kortelė</h5>
        </div>
        <form class="card-body" action='{{route('countries-store')}}' method='post'>
            <label for="exampleInputEmail1" class="form-label">Pavadinimas</label>
            <input required class="form-control form-control-lg mb-4" type="text" name="name">
            <label for="exampleInputEmail1" class="form-label">Sezono pradžios data</label>
            <input required class="form-control form-control-lg mb-4" type="date" name="season_start">
            <label for="exampleInputEmail1" class="form-label">Sezono pabaigos data</label>
            <input required class="form-control form-control-lg mb-4" type="date" name="season_end">
            <button type="submit" class="btn btn-outline-info">Sukurti</button>
            @csrf
        </form>
    </div>
</div>

@endsection
