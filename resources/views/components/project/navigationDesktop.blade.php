{{-- <!-- Для не авторизованного пользователя --> --}}
@guest
<nav class="nav flex-column navigation-for-desctop border mb-3">
  <a class="nav-link" aria-current="page" href="/">
    <i class="bi bi-house-door"></i>
    {{ __('Главная') }}
  </a>
  <a class="nav-link" aria-current="page" href="/login">
    <i class="bi bi-box-arrow-in-right"></i>
    {{ __('Войти') }}
  </a>
</nav>
@endguest

@auth
<nav class="nav flex-column navigation-for-desctop border mb-3">
  <a class="nav-link" aria-current="page" href="/">
    <i class="bi bi-house-door"></i>
    {{ __('Главная') }}
  </a>
  <a class="nav-link" aria-current="page" href="/profile">
    <i class="bi bi-person"></i>
    {{ __('Профиль') }}
  </a>
  <a class="nav-link" aria-current="page" href="/create/event">
    <i class="bi bi-clipboard-plus"></i>
    {{ __('Создать событие') }}
  </a>
  <a class="nav-link" aria-current="page" href="/get/bookmarks">
    <i class="bi bi-bookmark"></i>
    {{ __('Закладки') }}
  </a>
  <a class="nav-link" aria-current="page" href="/follow">
    <i class="bi bi-people"></i>
    {{ __('Подписки') }}
  </a>

  {{-- <!-- Безопасность --> --}}
  {{--
  <a class="nav-link" aria-current="page" href="/edit/security">
    <i class="bi bi-key"></i>
    {{ __('Безопасность') }}
  </a>
  --}}

  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <a class="nav-link" href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
      <i class="bi bi-box-arrow-left"></i>
      {{ __('Выход') }}
    </a>
  </form>
</nav>
@endauth