<!-- Header mobile -->
<div class="container-fluid d-lg-none main-light-shadow fixed-top bg-white">

    <div class="navbar navbar-light d-flex justify-content-between flex-nowrap" style="height: 70px;">

        <a href="/"
            class="text-center text-reset text-decoration-none @if(Route::is('general')) active-navigation-element @endif">
            <i class="bi bi-view-list"></i><br>
            <small>Поток</small>
        </a>
        <a href="/favourites"
            class="text-center text-reset text-decoration-none @if(Route::is('favourites')) active-navigation-element @endif">
            <i class="bi bi-check-lg"></i><br>
            <small>Подписки</small>
        </a>
        <a href="/event/add"
            class="text-center text-reset text-decoration-none @if(Route::is('event.add')) active-navigation-element @endif">
            <i class="bi bi-plus-circle-fill"></i><br>
            <small>Создать</small>
        </a>
        <a href="/bookmarks"
            class="text-center text-reset text-decoration-none @if(Route::is('bookmarks')) active-navigation-element @endif">
            <i class="bi bi-bookmark-check"></i><br>
            <small>Закладки</small>
        </a>
        
        @auth
        @php
        // Ну эт такой городок, чтобы подсветка пункта меню "Профиль" была только на странице авторизованного пользователя
        $path_user_id = $_SERVER['REQUEST_URI'];
        if ( str_starts_with($path_user_id, '/user') ) {
        $path_user_id = explode('/', $path_user_id);
        $path_user_id = $path_user_id[2];
        }
        @endphp
        <a href="/user/{{ Auth::id() }}"
            class="text-center text-reset text-decoration-none @if($path_user_id == Auth::id()) active-navigation-element @endif">
            <i class="bi bi-person"></i><br>
            <small>Профиль</small>
        </a>
        @endauth
        @guest
        <a href="/login" class="text-center text-reset text-decoration-none">
            <i class="bi bi-person"></i><br>
            <small>Профиль</small>
        </a>
        @endguest

    </div>

</div>
<!-- /Header mobile -->