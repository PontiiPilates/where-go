<x-rocketComponents.index
  :stdVarFavourites="$stdVarFavourites"
  :stdAvatar="$std_avatar"
  :userId="$user_id">

  <!-- Страница события -->
  <x-rocketComponents.sectionPageEvent
  :stdVarBookmarks="$stdVarBookmarks"
  :event="$event"
  :count="$count"
  :userId="$user_id"
  :runUsersIds="$run_users_ids"
  :viewsCount="$views_count">
  
</x-rocketComponents.sectionPageEvent>
  <!-- /Страница события -->

</x-rocketComponents.index>