@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-3">
            @include('front.categories')
        </div>
        <div class="col-9">
            <div class="card">
                <h3 class="fw-bold card-header text-center">
                    Kelionių sąrašas
                </h3>
                <ul class="list-group">
                    <form action="{{route('update-cart')}}" method="post">
                        @forelse($cartList as $hotel)
                        <li class="list-group-item d-flex mt-3">
                            <div class='col-2 mt-3'>
                                <div>{{$hotel->hotelCountry->name}}</div>
                                <h3>{{$hotel->name}}</h3>
                            </div>
                            @if($hotel->photo)
                            <img class='img-fluid img-thumbnail col-4' src="{{asset($hotel->photo)}}">
                            @else
                            <img class='img-fluid img-thumbnail col-4' src="{{asset('no.jpg')}}">
                            @endif
                            <div class='col-2 mt-3 ms-3'> Asmenų skaičius:
                                <input class='mt-2 col-10' type="number" min="1" name="count[]" value="{{$hotel->count}}">
                            </div>
                            <input type="hidden" name="ids[]" value="{{$hotel->id}}">
                            <div class='col-2 mt-3'>Kaina: <div class='mt-2'>{{$hotel->sum}} Eur</div>
                            </div>
                            <div class='col mt-3'>
                                <button type="submit" name="delete" value="{{$hotel->id}}" class="btn btn-outline-danger">Pašalinti</button>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item d-flex">Cart Empty</li>
                        @endforelse
                        <li class="list-group-item d-flex">
                            <button type="submit" class="btn btn-outline-primary">Atnaujinti</button>
                        </li>
                        @csrf
                    </form>
                </ul>
                <ul class="list-group">
                    <li class="list-group-item">
                        <form action="{{route('make-order')}}" method="post">
                            <button type="submit" class="btn btn-outline-primary">Įsigyti</button>
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
