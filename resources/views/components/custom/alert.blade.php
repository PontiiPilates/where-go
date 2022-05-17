<div {{ $attributes }} >
    {{ $slot }}
    {{ $var }}

    {{ $x }}


    @php
        // dd($attributes);
    @endphp
    <p>Залупа какая-то эти ваши компоненты</p>
    <strong>А, не, норм, хорошая штука</strong>
    <h1>{{ $title ?? 'Заглушка' }}</h1>
    <b>{{ $primitive }}</b>

</div>
