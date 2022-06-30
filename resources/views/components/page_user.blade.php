<div class="mb-5">
    <div class="d-flex justify-content-between mb-3">
        <div class="left-column d-flex flex-column justify-content-between">
            <strong class="card-title  mb-0 fs-4">{{ $user->name }}</strong>
            <div>
                <ul class="list-inline mb-0">

                    {{-- Контакты --}}
                    <x-section_contacts :phoneChecked="$user->phone_checked" :phone="$user->phone"
                        :telegramChecked="$user->telegram_checked" :telegram="$user->telegram"
                        :vkChecked="$user->vk_checked" :vk="$user->vk"
                        :whatsappChecked="$user->whatsapp_checked" :whatsapp="$user->whatsapp">
                    </x-section_contacts>

                </ul>
            </div>
            <div class="d-flex gap-3">
                <div>
                    <strong class="d-block m-0 p-0 lh-1 fs-5">{{ $user->count_follovers }}</strong>
                    <small class="d-block m-0 p-0 lh-1 text-secondary">подписчиков</small>
                </div>
                <div>
                    <strong class="d-block m-0 p-0 lh-1 fs-5">{{ $user->count_events }}</strong>
                    <small class="d-block m-0 p-0 lh-1 text-secondary">событий</small>
                </div>
            </div>
        </div>
        <div class="right-column">
            <img src="/public/img/avatars/{{ $user->avatar ?? 'default.jpg' }}" alt="image-profile" width="120"
                height="120" class="rounded-circle">
        </div>
    </div>
    <div class="mb-4">
        <p>{{ $user->about }}</p>
    </div>
    <div class="d-lg-block d-flex justify-content-between gap-3">

        @auth
        @if( Request::is( 'user/' . Auth::id() ) )
        <a href="/user/{{ $user->user_id }}/edit" class="btn btn-light border tools-bw-btn flex-fill">Редактировать</a>
        <x-button_share id="{{ $user->user_id }}"></x-button_share>
        @else
        @if( in_array( $user->user_id, session('favourites_list') ) )
        <button class="btn btn-light border tools-bw-btn flex-fill" id="subscribe">Отписаться</button>
        <x-button_share id="{{ $user->user_id }}"></x-button_share>
        @else
        <button class="btn btn-warning tools-bw-btn flex-fill" id="subscribe">Подписаться</button>
        <x-button_share id="{{ $user->user_id }}"></x-button_share>
        @endif
        @endif
        @endauth
        @guest
        <x-button_share class="share-link btn btn-light border tools-bw-btn" id="{{ $user->user_id }}">
        </x-button_share>
        @endguest

    </div>
</div>