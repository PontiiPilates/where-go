<ul class="list-unstyled">

    {{-- Stsrt --}}
    <li class=" text-truncate"><small><b>Начало:</b></small> {{ $item->date_start }} {{ $item->time_start ?? '' }}</li>

    {{-- Finish --}}
    @if($item->date_end)
    <li class=" text-truncate"><small><b>Окончание:</b></small> {{ $item->date_end }} {{ $item->time_end ?? '' }}</li>
    @endif
    
    <li class=" text-truncate"><small><b>Участие:</b></small> {{ $item->participant }}</li>
    {{-- <li class=" text-truncate"><small><b>Место встречи:</b></small> <abbr class="text-decoration-none" title="{{ $item->adress }}">{{ $item->adress }}</abbr></li> --}}

</ul>