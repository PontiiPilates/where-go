{{-- Фильтр событий на главной --}}

<div class="mb-5 pb-3 d-lg-none d-flex flex-wrap gap-2 mb-3 flex-column flex-sm-row">

    @foreach ($localstorage['selectors']['row_first'] as $k => $v)
        @if ($v > 0)
            <a href="/?selector={{ $k }}" class="facets btn btn-lg btn-outline-dark rounded-pill text-start">
                <span class="badge text-bg-secondary me-2">{{ $v }}</span>
                <span>{{ $k }}</span>
            </a>
        @endif
    @endforeach

    @foreach ($localstorage['selectors']['row_second'] as $k => $v)
        @if ($v > 0)
            <a href="/?selector={{ $k }}" class="facets btn btn-lg btn-outline-dark rounded-pill text-start">
                <span class="badge text-bg-secondary me-2">{{ $v }}</span>
                <span>{{ $k }}</span>
            </a>
        @endif
    @endforeach

</div>