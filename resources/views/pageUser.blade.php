{{-- Layout --}}
<x-rocketComponents.index :localstorage="$localstorage">
  
  {{-- Данные о пользователе --}}
  <x-rocketComponents.sectionProfile :user="$user"></x-rocketComponents.sectionProfile>

  {{-- Список событий --}}
  <x-rocketComponents.componentEventList :events="$events"></x-rocketComponents.componentEventList>

</x-rocketComponents.index>