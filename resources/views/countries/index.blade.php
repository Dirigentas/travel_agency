@extends('layouts.app')

@section('title', 'Šalių sąrašas')

@section('content')

<div class='container'>
    <div class="card">
        <h3 class="fw-bold card-header text-center">
            Šalių sąrašas
        </h3>
        <ul class="list-group container">
            @foreach($countries as $value)
            <li class="list-group-item d-flex">
                <div class='fw-bold col'> {{$value->country}}</div>
                <div class='col'> {{$value->season_start}}</div>
                <div class='col'> {{$value->season_end}}</div>
                <div class='col'>
                    <a href='{{route('countries-edit', $value)}}' class="btn btn-outline-primary">Redaguoti</a>
                </div>
                <form action='' method=' post' class='col'>
                    <button type="button" class="btn btn-outline-danger">Ištrinti</button>
                </form>

            </li>
            @endforeach
        </ul>
    </div>
</div>


@endsection
