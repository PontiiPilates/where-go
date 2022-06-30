{{-- Layout --}}
<x-layout :localstorage="$localstorage">

  {{-- Форма управления событием --}}
  <x-form_event :localstorage="$localstorage" :event="$event"></x-form_event>

</x-layout>