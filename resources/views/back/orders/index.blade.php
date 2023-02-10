@extends('layouts.app')

@section('title', 'Rezervacijų sąrašas')

@section('content')

<div class='container'>
    <div class="card">
        <h3 class="fw-bold card-header text-center">
            Rezervacijų sąrašas
        </h3>
        <ul class="list-group">
            @foreach($orders as $value)
            <li class="list-group-item d-flex">
                <div class='fw-bold col'># {{$value->user_id}}</div>
                <div class='col'> {{$value->drinks->total}}</div>
                <ul class="list-group">
                    @foreach($orders->hotels->hotels as $hotel)
                    <li class="list-group-item">
                        {{$hotel->name}} X {{$hotel->count}}
                    </li>
                    @endforeach
                </ul>
                <div class='col'> {{$value->status}}</div>


                {{-- <form action='' method='post' class='col'>
                    <button type="submit" class="btn btn-outline-danger">Ištrinti</button>
                    @method('delete')
                    @csrf
                </form> --}}

            </li>
            @endforeach
        </ul>
    </div>
</div>


@endsection
