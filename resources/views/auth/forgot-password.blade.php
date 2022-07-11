<x-layout_auth>

    {{-- Форма запроса на сброс пароля --}}
    <x-form_forgot :status="session('status')"></x-form_forgot>

</x-layout_auth>