@foreach ($events as $item)

<div class="container-event mb-3" style="border: 1px solid gray;">

<a href="/profile/{{ $item->user_id }}">{{ $item->name }}</a>

    <h6>{{ $item->title }}</h6>
    <p>{{ $item->adress }}</p>
    <p>{{ $item->city }}</p>
    <p>{{ $item->description }}</p>

    <small>{{ $item->id }}</small>
    <br>
    <small>{{ $item->user_id }}</small>


    @if(Auth::id() == $item->user_id)
    <a href="/event/edit/{{ $item->id }}">Редактировать</a>
    @endif

</div>

@endforeach