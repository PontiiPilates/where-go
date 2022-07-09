<div class="card mb-3 main-light-shadow border-white postiton-relative">
    <div class="row p-1 g-3">

        @if($item->preview)

        {{-- Left column--}}
        <div class="col col-lg-6" style="min-width: 300px;">

            {{-- Mobile --}}
            <div class="d-block d-sm-none position-relative p-0 mb-3">
                <x-card_event_header :item="$item"></x-card_event_header>
            </div>

            <img src="/public/img/previews/{{ $item->preview }}" class="img-fluid rounded" alt="img">

        </div>

        @endif

        {{-- Right column--}}
        <div class="col @if( $item->preview ) col-lg-6 @endif" style="min-width: 300px;">
            <div class="card-body position-relative h-100 p-0 pb-3">

                {{-- Desktop --}}
                <div class="d-none d-sm-block position-relative">
                    <x-card_event_header :item="$item"></x-card_event_header>
                </div>

                {{-- Заголовок --}}
                <a href="/event/{{ $item->id }}" class="text-reset">
                    <h5 class="card-title mb-0">{{ Str::limit($item->title, 60) }}</h5>
                </a>

                {{-- Категория --}}
                <x-card_event_category :item="$item"></x-card_event_category>

                {{-- Информация --}}
                <x-card_event_information :item="$item"></x-card_event_information>

                {{-- Статистика --}}
                <x-card_event_statistic :item="$item"></x-card_event_statistic>

                {{-- Поделиться --}}
                <div class="position-absolute bottom-0 end-0">
                    <x-card_event_share id="{{ $item->id }}"></x-card_event_share>
                </div>

            </div>
        </div>

    </div>

    @if( $item->last )

    {{-- Белый фон --}}
    <div class="position-absolute top-0 bottom-0 start-0 end-0 bg-white opacity-75">
    </div>

    {{-- Событие прошло --}}
    <a href="/event/{{ $item->id }}" class="text-reset text-decoration-none">
        <div class="position-absolute top-50 start-50 translate-middle bg-white rounded-circle opacity-100 main-strong-shadow d-flex flex-column justify-content-center align-items-center gap-2"
            style="height: 120px; width: 120px;">
            <div><i class="bi bi-hourglass-bottom"></i></div>
            <div class="text-center">Событие окончено</div>
        </div>
    </a>

    @endif

</div>