{{-- Header desctop --}}
<div class="container-fluid d-none d-lg-block main-light-shadow fixed-top bg-white">

    <div class="container-content">

        <div class="row navbar navbar-light" style="height: 70px;">

            {{-- Лого и слоган --}}
            <div class="col" style="padding-left: 12px; height: 54px">
                <a href="/" class="navbar-brand">
                    <h1 style="font-size: 20px; font-weight: bolder;">{{ __('Поиск мероприятий в Красноярске')}}<br>
                        <span class="fs-6" style="font-weight: normal">{{ __('Походы, сплавы, экскурсии, фестивали, выставки, тренинги, мастер-классы')}}</span>
                    </h1>
                </a>
            </div>

            <div class="col position-relative text-end">

                {{-- Уведомления --}}
                @auth

                    @if( count(session('notifications_unread')) )
                        <div class="btn-group me-2">

                            <button type="button" class="btn btn-light border rounded d-flex align-items-center position-relative" style="height: 46px;" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bell"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count(session('notifications_unread')) }}
                                </span>
                            </button>

                            <ul class="dropdown-menu p-0" style="width: 270px;">
                                @foreach (session('notifications_unread') as $notification)
                                    <li>
                                        <a href="/event/{{ $notification->data['event'] }}"
                                            class="btn btn-light d-flex gap-2 border-0">
                                            <img src="/public/img/avatars/{{ $notification->data['avatar'] }}" alt="avatar"
                                                class="rounded-circle tools-md-avatar">
                                            <div class="text-start">
                                                <strong>{{ Str::limit($notification->data['name'], 18) }}</strong>
                                                <small class="d-block">добавление нового события</small>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    @endif

                @endauth

                {{-- Профиль или войти --}}
                <div class="btn-group">

                    @auth
                    <button type="button" class="btn btn-light border rounded d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="/public/img/avatars/{{ session('avatar', 'default.jpg') }}" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong>{{ Str::limit(session('name'), 20) }}</strong>
                    </button>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/user/{{ Auth::id() }}">{{ __('Мой профиль') }}</a></li>
                        <li><a class="dropdown-item" href="/user/{{ Auth::id() }}/edit">{{ __('Настройки') }}</a></li>
                        <hr class="dropdown-divider">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Выйти') }}</button>
                            </form>
                        </li>
                    </ul>
                    @endauth

                    @guest
                    <a href="/login" class="btn btn-light border rounded d-flex align-items-center"><i class="bi bi-box-arrow-in-right me-2"></i>
                        <strong>{{ __('Войти') }}</strong>
                    </a>
                    @endguest

                </div>

            </div>

        </div>

    </div>
    
</div>