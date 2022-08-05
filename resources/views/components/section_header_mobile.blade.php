{{-- Header mobile --}}
<div class="container-fluid d-lg-none main-light-shadow fixed-top bg-white">

    <div class="navbar navbar-light d-flex justify-content-between flex-nowrap" style="height: 70px;">

        {{-- Поток --}}
        <a href="/" class="text-center text-reset text-decoration-none">
            <i class="bi bi-view-list"></i><br>
            <small>{{ __('Поток') }}</small>
        </a>

        @auth

            {{-- Уведомления --}}
            @if ( count(session('notifications_unread')) )
                <a href="/notifications" class="position-relative text-center text-reset text-decoration-none">
                    <i class="bi bi-bell position-relative">
                        @if( count(session('notifications_unread')) )
                            <span class="position-absolute translate-middle badge rounded-pill bg-danger" style="font-style:normal; left: 150%; top: 0;">
                                {{ count(session('notifications_unread')) }}
                            </span>
                        @endif
                    </i>
                    <br>
                    <small>{{ __('Уведомления') }}</small>
                </a>
            @endif

            {{-- Создать --}}
            <a href="/event/add" class="text-center text-reset text-decoration-none">
                <i class="bi bi-plus-circle"></i>
                <br>
                <small>{{ __('Создать') }}</small>
            </a>

            {{-- Еще --}}
            <div class="btn-group">

                <button type="button" class="btn btn-light border-0 rounded" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots"></i>
                    <br>
                    <small>{{ __('Еще') }}</small>
                </button>

                <ul class="dropdown-menu">
                    <li class="mb-2 mt-2">
                        <a class="dropdown-item position-relative" href="/favourites">
                            {{ __('Подписки') }}
                            @if( count(session('notifications_unread')) )
                                <span class="position-absolute top-50 translate-middle bg-danger border border-light rounded-circle" style="left: 90%"></span>
                            @endif
                        </a>
                    </li>
                    <li class="mb-2"><a class="dropdown-item" href="/bookmarks">{{ __('Закладки') }}</a></li>
                    <li class="mb-2"><a class="dropdown-item" href="/user/{{ Auth::id() }}">{{ __('Профиль') }}</a></li>
                    <li class="mb-2"><a class="dropdown-item" href="/user/{{ Auth::id() }}/edit">{{ __('Настройки') }}</a></li>
                    <li class="mb-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Выйти') }}</button>
                        </form>
                    </li>
                </ul>

            </div>

        @endauth

        @guest
            <a href="/login" class="text-center text-reset text-decoration-none">
                <i class="bi bi-box-arrow-in-right"></i>
                <br>
                <small>{{ __('Войти')}}</small>
            </a>
        @endguest

    </div>

</div>