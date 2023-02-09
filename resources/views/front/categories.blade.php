@inject('any_word', 'App\Services\CategoriesService')

<ul class="list-group">
    <a href='{{route('index')}}' class="list-group-item">Visi</a>
    @foreach($any_word->get() as $value)
    <a href='{{route('show-cats-hotels', $value->name)}}' class="list-group-item">{{$value->name}}</a>
    @endforeach
</ul>
