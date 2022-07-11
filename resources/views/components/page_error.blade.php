<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ __('Error') }}</title>
    <meta name="description" content="{{ __('Страница ошибки') }}">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- Favikon: путь скорректирован в .htaccess --}}
    <link rel="icon" href="favicon.svg">

    {{-- Main styles --}}
    <link rel="stylesheet" href="/resources/css/style.css">
</head>

<body>
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <div class="tools-bw-c">

            {{-- Error --}}
            <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">

                <div class="text-center tools-bw-c">
                    <h5>{{ __('Что-то пошло не так!') }}</h5>
                    <p class="mb-5">{{ __('Попробуйте еще раз. Если ошибка повторится, то опишите ее разработчику.') }}</p>
                    <div class="d-flex justify-content-between gap-3 w-100">
                        <a href="https://where-go.ru" class="btn btn-warning flex-fill">{{ __('На главную') }}</a>
                        <a href="https://t.me/zloileshii" class="btn btn-light border flex-fill">{{ __('К разработчику')}}</a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</body>

</html>