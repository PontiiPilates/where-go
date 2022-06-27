{{-- Layout --}}
<x-rocketComponents.index :localstorage="$localstorage">

    {{-- Фильтр событий для главной страницы в мобильной версии --}}
    <x-rocketComponents.componentFilterMobile :localstorage="$localstorage"></x-rocketComponents.componentFilterMobile>

    {{-- Список событий --}}
    <x-rocketComponents.componentEventList :events="$events"></x-rocketComponents.componentEventList>

</x-rocketComponents.index>