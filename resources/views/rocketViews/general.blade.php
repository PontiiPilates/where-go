<x-rocketComponents.index :localstorage="$localstorage">

    {{-- Фильтр событий на главной --}}
    <div class="mb-5 pb-3 d-lg-none">
        <form method="get" action="">

            {{-- Фильтр по городу --}}
            <div class="mb-3">
                <x-rocketComponents.componentFieldFilterCity :localstorage="$localstorage"></x-rocketComponents.componentFieldFilterCity>
            </div>

            <div class="mb-3">
                {{-- Фильтр по категории --}}
                <x-rocketComponents.componentFieldFilterCategory :localstorage="$localstorage"></x-rocketComponents.componentFieldFilterCategory>
            </div>
            
            <div class="mb-4">
                {{-- Фильтр по дате --}}
                <x-rocketComponents.componentFieldFilterDate></x-rocketComponents.componentFieldFilterDate>
            </div>

            <button name="filter" value="true" type="submit" class="btn btn-warning w-100 text-start"><i
                    class="bi bi-search me-2"></i>{{ __('Искать') }}</button>

        </form>
    </div>

    {{-- Список событий --}}
    <x-rocketComponents.componentEventList :events="$events"></x-rocketComponents.componentEventList>

</x-rocketComponents.index>