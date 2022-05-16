@if(Request::is('follow'))
@if ( !collect($follows)->all() )
<div class="alert alert-info" role="alert">У вас пока нет подписок, подпишитесь на кого-нибудь</div>
@endif
@endif

@foreach( $follows as $k => $v)

<div class="card mb-3 w-100">
    <div class="d-flex flex-row">

        <div class="d-flex ps-3">
            <img src="/public/img/avatars/{{ $v->avatar }}" class="rounded align-self-center" width="64" height="64" alt="...">
        </div>

        <div class="">
            <div class="card-body">
                <a href="/profile/{{ $v->user_id }}" class="link-dark" style="text-decoration: none;">
                    <h5 class="card-title">{{ $v->name }}</h5>
                </a>
                <p class="card-text"><small class="text-muted">{{ $v->city }}</small></p>
            </div>
        </div>

        <div class="position-absolute top-0 end-0 d-flex">

            <div style="width: 42px; height: 38px" class="btn">
                <i class="follow bi bi-person-check-fill" id="{{ $v->user_id }}"></i>
            </div>

        </div>

    </div>
</div>

@endforeach