<x-rocketComponents.index
:stdVarFavourites="$stdVarFavourites"
:stdAvatar="$std_avatar"
:userId="$user_id">

  <!-- Форма создания события -->
  <x-rocketComponents.sectionEventAdd
    :id="$event->id"
    :title="$event->title"
    :description="$event->description"
    :preview="$event->preview"
    :city="$event->city"
    :adress="$event->adress"
    :category="$event->category"
    :dateStart="$event->date_start"
    :timeStart="$event->time_start"
    :dateEnd="$event->date_end"
    :timeEnd="$event->time_end"
    :priceType="$event->price_type"
    :cost="$event->cost"
    :eventWitness="$event->witness"

    :userWitness="$user_witness">
  </x-rocketComponents.sectionEventAdd>
  <!-- /Форма создания события -->

</x-rocketComponents.index>