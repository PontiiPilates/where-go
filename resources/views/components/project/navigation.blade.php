<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <!-- <a class="navbar-brand" href="#">Navbar</a> -->
    <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Главная</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/event/create">Создать событие</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/profile/{{ Auth::id() }}">Профиль</a>
        </li>


        <!-- <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li> -->

      </ul>
    </div>
  </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/login">Войти</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/register">Регистрация</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/dashboard">Своя страница</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" style="color: orangered;"href="/user/security">Безопасность</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" style="color: orangered;" aria-current="page" href="/forgot-password">Забыл пароль</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="http://wherego/logout">Выйти</a>
        </li>

      </ul>
    </div>
  </div>
</nav>