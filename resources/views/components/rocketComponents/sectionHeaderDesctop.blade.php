 <!-- Header desctop -->
 <div class="container-fluid d-none d-lg-block main-light-shadow fixed-top bg-white">
     <div class="container-content">
         <div class="row navbar navbar-light" style="height: 70px;">

             <!-- Лого и слоган -->
             <div class="col" style="padding-left: 16px;">
                 <a href="#" class="navbar-brand lh-1">
                     <strong>Найди событие по душе</strong><br>
                     <small>или создай своё</small>
                 </a>
             </div>
             <!-- /Лого и слоган -->

             <!-- Профиль -->
             <div class="col position-relative text-end">
                 <div class="btn-group">
                     @auth
                     <button type="button" class="btn btn-light border rounded d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                         <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                         <strong>
                             {{ Auth::user()->name }}
                         </strong>
                     </button>
                     @endauth
                     <ul class="dropdown-menu">
                         <li><a class="dropdown-item" href="#">Профиль</a></li>
                         <li><a class="dropdown-item" href="#">Настройки</a></li>
                         <hr class="dropdown-divider">
                         <li><a class="dropdown-item" href="#">Выйти</a></li>
                     </ul>
                 </div>
             </div>
             <!-- /Профиль -->

         </div>
     </div>
 </div>
 <!--/Header desctop -->