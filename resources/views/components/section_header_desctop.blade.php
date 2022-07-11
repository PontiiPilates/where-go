 {{-- Header desctop --}}
 <div class="container-fluid d-none d-lg-block main-light-shadow fixed-top bg-white">
     <div class="container-content">
         <div class="row navbar navbar-light" style="height: 70px;">

             {{-- Лого и слоган --}}
             <div class="col" style="padding-left: 16px;">
                 <a href="/" class="navbar-brand lh-1">
                     <strong>Все события здесь</strong><br>
                     <small>найди подходящее или создай своё</small>
                 </a>
             </div>

             {{-- Профиль --}}
             <div class="col position-relative text-end">
                 <div class="btn-group">
                     @auth
                     <button type="button" class="btn btn-light border rounded d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                         <img src="/public/img/avatars/{{ session('avatar', 'default.jpg') }}" alt="" width="32" height="32" class="rounded-circle me-2">
                         <strong>
                             {{ session('name') }}
                         </strong>
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
                     <a href="/login" class="btn btn-light border rounded d-flex align-items-center">
                         <i class="bi bi-box-arrow-in-right me-2"></i>
                         <strong>{{ __('Войти') }}</strong>
                     </a>
                     @endguest
                 </div>
             </div>

         </div>
     </div>
 </div>