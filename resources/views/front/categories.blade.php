@inject('any_word', 'App\Services\CategoriesService')

<ul class="list-group">
    <a href='{{route('index')}}' @if(!isset($country)) class="list-group-item active" @else class="list-group-item" @endif>Visos šalys</a>

    @foreach($any_word->get() as $value)
    <a href='{{route('show-cats-hotels', $value->name)}}' @if(isset($country) && $country==$value->name) class="list-group-item active" @else class="list-group-item" @endif>{{$value->name}}</a>


    @endforeach
</ul>
