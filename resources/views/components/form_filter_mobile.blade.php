    {{-- Фильтр событий на главной --}}
    <div class="mb-5 pb-3 d-lg-none">
        <form method="get" action="">

            {{-- Фильтр по городу --}}
            {{-- <div class="mb-3"> --}}
                {{-- <x-field_city_filter :localstorage="$localstorage"></x-field_city_filter> --}}
            {{-- </div> --}}

            <div class="mb-3">
                {{-- Фильтр по категории --}}
                <x-field_category_filter :localstorage="$localstorage"></x-field_category_filter>
            </div>
            
            <div class="mb-4">
                {{-- Фильтр по дате --}}
                <x-field_data_filter></x-field_data_filter>
            </div>

            <button name="filter" value="true" type="submit" class="btn btn-warning w-100 text-start"><i
                    class="bi bi-search me-2"></i>{{ __('Искать') }}</button>

        </form>
    </div>