@extends('layouts.app')

@section('title', 'Rezervacijų sąrašas')

@section('content')

<div class='container'>
    <div class="card">
        <h3 class="fw-bold card-header text-center">
            Rezervacijų sąrašas
        </h3>
        <ul class="list-group">
            @foreach($orders as $order)
            <li class="list-group-item d-flex">
                <div class='fw-bold col-1'># {{$order->id}}</div>
                <div class='fw-bold col-1'> {{$order->user->name}}</div>
                <ul class="list-group col-4">
                    @foreach($order->hotels->hotels as $hotel)
                    <li class="list-group-item">
                        <div class='text-center fw-bold'>{{$hotel->name}}</div>
                        <div class='text-center'>{{round($hotel->price, 0)}} Eur X {{$hotel->count}} vnt. = {{$hotel->price * $hotel->count}} Eur</div>
                    </li>
                    @endforeach
                </ul>
                <div class='col-2 text-center'>
                    <div class='fw-bold'>Iš viso: </div>
                    <div>{{$order->hotels->total}} Eur</div>
                </div>
                <div class='col'> @if($order->status) Kelionė patvirtinta @else Laukiama patvirtinimo @endif </div>
                <form action='' method='post' class='col'>
                    <button type="submit" class="btn btn-outline-success">Patvirtinti</button>
                    @method('put')
                    @csrf
                </form>
                <form action='' method='post' class='col'>
                    <button type="submit" class="btn btn-outline-danger">Ištrinti</button>
                    @method('delete')
                    @csrf
                </form>
            </li>
            @endforeach
        </ul>
    </div>
</div>


@endsection
