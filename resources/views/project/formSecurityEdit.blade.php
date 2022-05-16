<x-project.layout>

    <div class="col-lg-1 d-none d-lg-block"></div>
    <div class="col-lg-4 d-none d-lg-block">

        <div class="outer-container fixed-collumn">
            <div class="inner-container">
                <!-- <div class="fixed-collumn"> -->

                {{-- <!-- Навигация, видимая при двухколоночной вёрстке. --> --}}
                <div class="d-none d-lg-block">
                    <x-project.navigationDesktop>
                        </x-project.navigationDesctop>
                </div>

                {{-- <!-- Информация о профиле для двух колонок --> --}}
                <x-project.profile :profile="$profile">
                </x-project.profile>

                {{-- <!-- Футер, видимый при двухколоночной вёрстке --> --}}
                <div class="d-none d-lg-block">
                    <x-project.footerDesktop>
                    </x-project.footerDesctop>
                </div>

            </div>
        </div>

    </div>

    <div class="col-lg-6 d-none d-lg-block">
        <x-project.formSecurityEdit :user="$user">
        </x-project.formSecurityEdit>
    </div>
    <div class="col-lg-1"></div>
    
    <div class="d-lg-none">
        <x-project.formSecurityEdit :user="$user">
        </x-project.formSecurityEdit>
    </div>


</x-project.layout>