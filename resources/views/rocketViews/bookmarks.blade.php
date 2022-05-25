<x-rocketComponents.index
:stdVarFavourites="$stdVarFavourites"
:stdAvatar="$std_avatar"
:userId="$user_id">

  <!-- Компонент: вывод списка событий -->
  <x-rocketComponents.componentEventList
    :events="$events"
    :bookmarks="$bookmarks">
  </x-rocketComponents.componentEventList>
  <!-- /Компонент: вывод списка событий -->

</x-rocketComponents.index>