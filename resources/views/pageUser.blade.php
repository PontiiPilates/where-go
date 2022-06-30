{{-- Layout --}}
<x-layout :localstorage="$localstorage">
  
  {{-- Данные о пользователе --}}
  <x-page_user :user="$user"></x-page_user>

  {{-- Список событий --}}
  <x-list_events :events="$events"></x-list_events>

</x-layout>