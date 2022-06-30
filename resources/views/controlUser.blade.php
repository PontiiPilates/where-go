{{-- Layout --}}
<x-layout :localstorage="$localstorage">

  {{-- Настройки профиля авторизованного пользователя --}}
  <x-form_settings :active="$active"></x-form_settings>

</x-layout>