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
            <div class="d-none d-lg-block">
                <x-project.filters>
                </x-project.filters>
            </div>

            {{-- <!-- Футер, видимый при двухколоночной вёрстке --> --}}
            <div class="d-none d-lg-block">
                <x-project.footerDesktop>
                    </x-project.footerDesctop>
            </div>

        </div>
    </div>

    <div class="col-lg-6">

        @auth
        <x-project.pageEvent :event="$event" :creator="$creator" :bookmarks="$bookmarks">
        </x-project.pageEvent>
        @endauth

        @guest
        <x-project.pageEvent :event="$event" :creator="$creator">
        </x-project.pageEvent>
        @endguest

    </div>
    <div class="col-lg-1"></div>

</x-project.layout>