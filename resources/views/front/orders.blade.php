@extends('layouts.front')

@section('title', 'Įsigytos kelionės')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-3">
            @include('front.categories')
        </div>
        <div class="col-9">
            <div class="card">
                <h3 class="fw-bold card-header text-center">
                    Įsigytos kelionės
                </h3>
                <ul class="list-group">
                    @foreach($orders as $order)
                    <li class="list-group-item d-flex">
                        <ul class="list-group col-12">
                            @foreach($order->hotels->hotels as $hotel)
                            <li class="list-group-item pb-4">
                                <div class='col-9 text-center fw-bold'>{{$hotel->name}}</div>
                                <div class='row'>
                                    <div class='col-9 text-center'>{{round($hotel->price, 0)}} Eur X {{$hotel->count}} vnt. = {{$hotel->price * $hotel->count}} Eur</div>
                                    <div class='col text-end'> @if($order->status) Kelionė patvirtinta @else Laukiama patvirtinimo @endif </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <div class='text-end card-footer'>
                        <div class='fw-bold'>Kelionių vertė: </div>
                        <div>{{$order->hotels->total}} Eur</div>
                    </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
