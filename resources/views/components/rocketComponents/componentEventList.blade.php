@foreach($events as $item)

<!-- Карточка события -->
<x-rocketComponents.sectionEventCard
  :title="$item->title"
  :dateStart="$item->date_start"
  :preview="$item->preview"
  :avatar="$item->avatar"
  :username="$item->name"
  :category="$item->category"
  :id="$item->id"
  :creatorId="$item->user_id"
  :bookmarks="$bookmarks"
  :viewsCount="$item->counter"
  :adress="$item->adress"
  :priceType="$item->price_type"
  :cost="$item->cost"
  :goes="$item->goes">
</x-rocketComponents.sectionEventCard>
<!-- /Карточка события -->

@endforeach