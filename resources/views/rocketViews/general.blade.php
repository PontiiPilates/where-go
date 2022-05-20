<x-rocketComponents.index
:stdVarFavourites="$stdVarFavourites"
:stdAvatar="$stdAvatar"
:userId="$userId">

  <!-- Компонент: вывод списка событий -->
  <x-rocketComponents.componentEventList
    :events="$events"
    :bookmarks="$bookmarks">
  </x-rocketComponents.componentEventList>
  <!-- /Компонент: вывод списка событий -->

</x-rocketComponents.index>