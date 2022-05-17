<x-rocketComponents.index
  :stdVarFavourites="$stdVarFavourites"
  :stdAvatar="$std_avatar"
  :userId="$user_id"
>

  <!-- Профиль -->
    <x-rocketComponents.sectionProfile
    :userId="$user->id"
    :name="$user->name"
    :avatar="$user->avatar"

    :phone="$user->phone"
    :phoneChecked="$user->phone_checked"

    :telegram="$user->telegram"
    :telegramChecked="$user->telegram_checked"

    :whatsapp="$user->whatsapp"
    :whatsappChecked="$user->whatsapp_checked"

    :viber="$user->viber"
    :viberChecked="$user->viber_checked"

    :instagram="$user->instagram"
    :instagramChecked="$user->instagram_checked"

    :eventsCount="25"
    :folloversCount="46"

    :about="$user->about"

    :favourites="$favourites">
    </x-rocketComponents.sectionProfile>
  <!-- /Профиль -->

  <!-- Компонент: вывод списка событий -->
  <x-rocketComponents.componentEventList
    :events="$events"
    :bookmarks="$bookmarks">
  </x-rocketComponents.componentEventList>
  <!-- /Компонент: вывод списка событий -->

</x-rocketComponents.index>