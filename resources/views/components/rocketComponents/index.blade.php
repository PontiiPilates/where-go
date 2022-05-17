<!DOCTYPE html>
<html lang="ru">

<head>
    <x-rocketComponents.head>
        <x-slot name="title">Where-go</x-slot>
    </x-rocketComponents.head>
</head>

<body>

    <!-- Header desctop -->
    <x-rocketComponents.sectionHeaderDesctop
    :stdAvatar="$stdAvatar"
    :userId="$userId">
    </x-rocketComponents.sectionHeaderDesctop>
    <!-- /Header desctop -->

    <!-- Header mobile -->
    <x-rocketComponents.sectionHeaderMobile></x-rocketComponents.sectionHeaderMobile>
    <!-- /Header mobile -->

    <!-- Контент -->
    <div class="container-fluid">
        <div class="container-content">
            <div class="row" style="margin-top: 70px;">
                <div class="sf-rail col-lg-3 d-none d-lg-block">

                    <!-- Левый сайдбар -->
                    <x-rocketComponents.sectionLeftSidebar :stdVarFavourites="$stdVarFavourites"></x-rocketComponents.sectionLeftSidebar>
                    <!-- /Левый сайдбар -->

                </div>

                <!-- Разделитель колонок -->
                <div class="col-1 d-none d-lg-block"></div>
                <!-- /Разделитель колонок -->

                <!-- Правая колонка -->
                <div class="col col-lg-8 pt-5">

                    {{ $slot }}


                    {{--

                    

                    
                    
                    



                    

                    
                    <!-- Фильтр для мобильных устройств -->
                    <x-rocketComponents.sectionFilterMobile></x-rocketComponents.sectionFilterMobile>
                    <!-- /Фильтр для мобильных устройств -->
                    
                    
                    
                    
                    <!-- Модальное окно созданного события -->
                    <x-rocketComponents.modalWindowEventDone></x-rocketComponents.modalWindowEventDone>
                    <!-- /Модальное окно созданного события -->
                    
                    --}}


                </div>
                <!-- /Правая колонка -->

            </div>

        </div>
    </div>
    <!-- /Контент -->

    <!-- Scripts -->
    <script src="/resources/js/costField.js"></script>
    <script src="/resources/js/openList.js"></script>
    <script src="/resources/js/addPoppers.js"></script>
    <script src="/resources/js/fork.js"></script>
    <script src="/resources/js/transmitter.js"></script>
    <script src="/resources/js/uppopup.js"></script>
    <!-- /Scripts -->

</body>

</html>