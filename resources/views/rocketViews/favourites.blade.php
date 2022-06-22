<x-rocketComponents.index :localstorage="$localstorage">

  {{-- Список пользователей --}}
  <x-rocketComponents.sectionFavourites :data="session('favourites_obj')"></x-rocketComponents.sectionFavourites>

</x-rocketComponents.index>