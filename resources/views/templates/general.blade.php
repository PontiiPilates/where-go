<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    {{ $var }}
    <h1>{{ $title }}</h1>

    @include('templates.fragment', ['status' => 'go'])

    <x-custom.alert primitive="hello, i niga" :title="$title" class="a">
        <x-slot name="var">
            Hello
        </x-slot>

        <x-slot name="x">
            <h6>Submited</h6>
        </x-slot>

        <a href="##">Сюда иди!</a>
    </x-custom.alert>

    <style>
        .a {
            border: 1px solid black;
        }
    </style>

</body>

</html>