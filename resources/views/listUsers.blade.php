{{-- Layout --}}
<x-layout :localstorage="$localstorage">

  {{-- Список пользователей --}}
  <x-list_users :data="$users"></x-list_users>

</x-layout>