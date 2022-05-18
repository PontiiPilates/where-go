 <!-- Профиль -->
 <div class="mb-5">
     <div class="d-flex justify-content-between mb-3">
         <div class="left-column d-flex flex-column justify-content-between">
             <strong class="card-title text-truncate mb-0 fs-4">{{ $name }}</strong>
             <div>
                 <ul class="list-inline mb-0">

                     <!-- Компонент: иконки контактов -->
                     <x-rocketComponents.componentContacts
                        :phoneChecked="$phoneChecked"
                        :phone="$phone"
                        :telegramChecked="$telegramChecked"
                        :telegram="$telegram"
                        :whatsappChecked="$whatsappChecked"
                        :whatsapp="$whatsapp">
                     </x-rocketComponents.componentContacts>
                     <!-- /Компонент: иконки контактов -->

                 </ul>
             </div>
             <div class="d-flex gap-3">
                 <div>
                     <strong class="d-block m-0 p-0 lh-1 fs-5">{{ $folloversCount }}</strong>
                     <small class="d-block m-0 p-0 lh-1 text-secondary">подписчиков</small>
                 </div>
                 <div>
                     <strong class="d-block m-0 p-0 lh-1 fs-5">{{ $eventsCount }}</strong>
                     <small class="d-block m-0 p-0 lh-1 text-secondary">событий</small>
                 </div>
             </div>
         </div>
         <div class="right-column">
             <img src="/public/img/avatars/{{ $avatar ?? 'default.jpg' }}" alt="image-profile" width="120" height="120" class="rounded-circle">
         </div>
     </div>
     <div class="mb-4">
         <p>{{ $about }}</p>
     </div>
     <div class="d-lg-block d-flex justify-content-between gap-3">

         @if( Auth::id() == $userId)
         <a href="/user/{{ $userId }}/edit" class="btn btn-light border tools-bw-btn flex-fill">Редактировать</a>
         <!-- Поделиться -->
         <button
            class="share-link btn btn-light border ms-lg-3"
            data-bs-trigger="click"
            data-bs-toggle="tooltip"
            data-bs-placement="left"
            title="Ссылка скопирована"
            data-bs-original-title="Ссылка скопирована"
            data-main-uri="https://where-go.ru/user/{{ $userId }}">
                <i class="bi bi-reply-fill"></i>
         </button>
         <!-- /Поделиться -->
         @else
         @auth

         @php
         // Это нужно для того, чтобы условие ниже могло съесть переменную в случае, если у пользователя еще нет закладок
         if(!$favourites) {
         $favourites = array();
         }
         @endphp


         @if(in_array($userId, $favourites) )
         <button class="btn btn-light border tools-bw-btn flex-fill" id="subscribe">Отписаться</button>
         @else
         <button class="btn btn-warning tools-bw-btn flex-fill" id="subscribe">Подписаться</button>
         @endif

         <!-- Поделиться -->
         <button class="share-link btn btn-light border ms-lg-3" data-bs-trigger="click" data-bs-toggle="tooltip" data-bs-placement="left" title="Ссылка скопирована" data-bs-original-title="Ссылка скопирована" data-main-uri="https://where-go.ru/user/{{ $userId }}">
             <i class="bi bi-reply-fill"></i>
         </button>
         <!-- /Поделиться -->
         @endauth
         @endif

     </div>
 </div>
 <!-- /Профиль -->