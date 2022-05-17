<ul>

    <h2>{{ $title }}</h2>

    @foreach ($data as $item)
    <li>
        <h3>{{ $item }}</h3>
    </li>
    @endforeach


    <p>{{ $lorem ?? 'Не передалось'}}</p>

</ul>