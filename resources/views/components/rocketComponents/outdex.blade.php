<!DOCTYPE html>
<html lang="ru">

<head>
    <x-rocketComponents.head>
        <x-slot name="title">Where-go</x-slot>
    </x-rocketComponents.head>
</head>

<body>
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <div class="tools-bw-c">

            {{ $slot }}

            {{--
                <!-- Форма восстановления пароля -->
                <x-rocketComponents.emptyForgot></x-rocketComponents.emptyForgot>
                <!-- /Форма восстановления пароля -->

                <!-- 404 -->
                <x-rocketComponents.empty404></x-rocketComponents.empty404>
                <!-- /404 -->
            --}}

        </div>
    </div>
</body>

</html>