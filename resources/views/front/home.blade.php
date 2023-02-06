@extends('layouts.front')

@section('title', 'Kelionių agentūra')

@section('content')

<div class='container text-center'>
    <div class='col-3'>

    </div>
    <div class='col-9'>
        <div class="card">
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
