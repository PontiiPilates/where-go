{{-- Layout --}}
<x-layout :localstorage="$localstorage">

    {{-- Фильтр событий для главной страницы в мобильной версии --}}
    @unless(Request::is('bookmarks'))
        <x-form_filter_mobile :localstorage="$localstorage"></x-form_filter_mobile>
    @endunless

    {{-- Список событий --}}
    <x-list_events :events="$events"></x-list_events>

</x-layout>