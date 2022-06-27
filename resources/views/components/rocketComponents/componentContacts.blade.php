@if( $phoneChecked )
<li class="list-inline-item">
    <a href="tel:{{ $phone }}">
        <img class="tools-bs-social" src="/public/img/icons/telephone.svg">
    </a>
</li>
@endif

@if( $telegramChecked )
<li class="list-inline-item">
    <a href="https://t.me/{{ $telegram }}">
        <img class="tools-bs-social" src="/public/img/social_icons/telegram.svg">
    </a>
</li>
@endif

@if( $vkChecked )
<li class="list-inline-item">
    <a href="https://vk.com/{{ $vk }}">
        <img class="tools-bs-social" src="/public/img/social_icons/vk.svg">
    </a>
</li>
@endif

@if( $whatsappChecked )
<li class="list-inline-item">
    <a href="https://api.whatsapp.com/send?phone={{ $whatsapp }}">
        <img class="tools-bs-social" src="/public/img/social_icons/whatsapp.svg">
    </a>
</li>
@endif