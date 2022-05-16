<nav class="navbar navbar-dark bg-primary mb-3 gap-3">

  {{-- <!-- Для не авторизованного пользователя --> --}}
  @guest
  <a class="btn btn-outline-light flex-fill" aria-current="page" href="/">
    <i class="bi bi-house-door"></i>
    {{ __('Главная') }}
  </a>

  <a class="btn btn-outline-light flex-fill" aria-current="page" href="/login">
    <i class="bi bi-box-arrow-in-right"></i>
    {{ __('Войти') }}
  </a>
  @endguest

  {{-- <!-- Для авторизованного пользователя --> --}}
  @auth

  {{-- <!-- Главная --> --}}
  <a class="btn btn-outline-light flex-fill" aria-current="page" href="/">
    <i class="bi bi-house-door"></i>
  </a>

  {{-- <!-- Создать --> --}}
  <a class="btn btn-outline-light flex-fill" aria-current="page" href="/create/event">
    <i class="bi bi-clipboard-plus"></i>
  </a>

  {{-- <!-- Закладки --> --}}
  <a class="btn btn-outline-light flex-fill" aria-current="page" href="/get/bookmarks">
    <i class="bi bi-bookmarks"></i>
  </a>
  {{-- <!-- Подписки --> --}}
  <a class="btn btn-outline-light flex-fill" aria-current="page" href="/follow">
  <i class="bi bi-people"></i>
  </a>

  {{-- <!-- Профиль --> --}}
  <a class="btn btn-outline-light flex-fill" aria-current="page" href="/profile/{{ Auth::id() }}">
    <i class="bi bi-person"></i>
  </a>

  {{-- <!-- Выход --> --}}
  <form method="POST" action="{{ route('logout') }}" class="flex-fill">
    @csrf
    <a class="btn btn-outline-light w-100" href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
      <i class="bi bi-box-arrow-in-right"></i>
    </a>
  </form>

  @endauth

</nav>