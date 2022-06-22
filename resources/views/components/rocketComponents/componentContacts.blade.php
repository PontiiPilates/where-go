@if( $phoneChecked )
<li class="list-inline-item">
    <a href="tel:{{ $phone }}">
        <img class="tools-bs-social" src="/public/img/icons/Telephone.svg">
    </a>
</li>
@endif

@if( $telegramChecked )
<li class="list-inline-item">
    <a href="https://t.me/{{ $telegram }}">
        <img class="tools-bs-social" src="/public/img/social_icons/Telegram.svg">
    </a>
</li>
@endif

@if( $whatsappChecked )
<li class="list-inline-item">
    <a href="https://api.whatsapp.com/send?phone={{ $whatsapp }}">
        <img class="tools-bs-social" src="/public/img/social_icons/WhatsApp.svg">
    </a>
</li>
@endif