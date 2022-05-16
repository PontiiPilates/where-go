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
  :bookmarks="$bookmarks">
</x-rocketComponents.sectionEventCard>
<!-- /Карточка события -->

@endforeach