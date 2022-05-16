<x-project.layout>

    <div class="col-lg-1"></div>
    <div class="col-lg-4">
        <div class="fixed-collumn">

            {{-- <!-- Навигация, видимая при двухколоночной вёрстке. --> --}}
            <div class="d-none d-lg-block">
                <x-project.navigationDesktop>
                    </x-project.navigationDesctop>
            </div>

            {{-- <!-- Фильтр для двух колонок --> --}}
            <x-project.filters>
            </x-project.filters>

            {{-- <!-- Футер, видимый при двухколоночной вёрстке --> --}}
            <div class="d-none d-lg-block">
                <x-project.footerDesktop>
                    </x-project.footerDesctop>
            </div>

        </div>
    </div>

    <div class="col-lg-6">

        @auth
        <x-project.eventsList :events="$events" :bookmarks="$bookmarks">
        </x-project.eventsList>
        @endauth

        @guest
        <x-project.eventsList :events="$events">
        </x-project.eventsList>
        @endguest


    </div>
    <div class="col-lg-1"></div>

</x-project.layout>