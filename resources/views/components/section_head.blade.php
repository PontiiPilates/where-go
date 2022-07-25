<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

{{-- Meta --}}
<title>{{ $localstorage['meta']['title'] ?? $localstorage['meta']['title_default'] ?? '' }}</title>
<meta name="description" content="{{ $localstorage['meta']['description'] ?? $localstorage['meta']['description_default'] ?? '' }}">

@if (Request::is('/'))
{{-- Keywords --}}
<meta name="keywords" content="{{$localstorage['meta']['keywords']}}"/>
{{-- Канонический адрес: борьба с присутствием дублей страниц с гет-параметрами в вебмастере --}}
<link rel="canonical" href="https://where-go.ru/"/>
@endif

@if (Request::is('event/*'))
@php
$event_id = explode('/', Request::path());
@endphp
{{-- Канонический адрес: борьба с присутствием дублей страниц с гет-параметрами в вебмастере --}}
<link rel="canonical" href="https://where-go.ru/event/{{ $event_id[1] }}"/>
@endif

@if(!Request::all())
{{-- Yandex.Metrika counter: борьба с гет параметрами при индексировании --}}
<x-yandex_metrica></x-yandex_metrica>
@endif

{{-- Bootstrap --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

{{-- Bootstrap icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

{{-- Jq --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

{{-- Favikon: путь скорректирован в .htaccess --}}
<link rel="icon" href="/favicon.svg">

{{-- Main styles --}}
<link rel="stylesheet" href="/resources/css/style.css">