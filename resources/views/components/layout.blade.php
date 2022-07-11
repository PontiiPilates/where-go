<!DOCTYPE html>
<html lang="ru">

<head>
    {{-- Head --}}
    <x-section_head :localstorage="$localstorage"></x-section_head>
    {{-- <x-slot name="title">Where-go</x-slot> --}}
</head>

<body>

    {{-- Header desctop --}}
    <x-section_header_desctop></x-section_header_desctop>

    {{-- Header mobile --}}
    <x-section_header_mobile></x-section_header_mobile>

    {{-- Контент --}}
    <div class="container-fluid">
        <div class="container-content">
            <div class="row" style="margin-top: 70px;">
                <div class="sf-rail col-lg-3 d-none d-lg-block">

                    {{-- Левый сайдбар --}}
                    <x-section_left_sidebar :localstorage="$localstorage"></x-section_left_sidebar>

                </div>

                {{-- Разделитель колонок --}}
                <div class="col-1 d-none d-lg-block"></div>

                {{-- Правая колонка --}}
                <div class="col col-lg-8 pt-5">{{ $slot }}</div>

            </div>

        </div>
    </div>

    {{-- Scripts --}}
    <script src="/resources/js/costField.js"></script>
    <script src="/resources/js/openList.js"></script>
    <script src="/resources/js/addPoppers.js"></script>
    <script src="/resources/js/fork.js"></script>
    <script src="/resources/js/transmitter.js"></script>
    <script src="/resources/js/uppopup.js"></script>

    {{-- Wysiwyg: требуется только на странице управления событием --}}
    <script src="/resources/js/wysiwyg.js"></script>
</body>

</html>