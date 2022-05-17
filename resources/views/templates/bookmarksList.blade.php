<x-custom.layout>

    <x-custom.leftsidebar image="this is avatar">
        <b>http://chto-totam.ru</b>
    </x-custom.leftsidebar>

    <x-custom.bookmarksList :data="$data">
        <x-slot name="lorem">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora rerum, natus, maiores non quia inventore repellendus assumenda magnam perferendis ipsa dolorem! Repellendus nisi consequatur porro est facere libero unde corporis.
        </x-slot>
        <x-slot name="title">
            Hello World
        </x-slot>

    </x-custom.bookmarksList>

</x-custom.layout>