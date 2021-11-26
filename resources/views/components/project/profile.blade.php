<p>{{ $profile->name }}</p>
<img src="{{ $profile->avatar }}" alt="{{ $profile->avatar }}" width="100">
<p>{{ $profile->about }}</p>
<p>{{ $profile->city }}</p>
<p>{{ $profile->phone }}</p>
<p>{{ $profile->wp }}</p>
<p>{{ $profile->wb }}</p>
<p>{{ $profile->tg }}</p>
<p>{{ $profile->ig }}</p>
<p>{{ $profile->fb }}</p>
<p>{{ $profile->vk }}</p>
<p>{{ $profile->ok }}</p>
<p>{{ $profile->yt }}</p>

@if (Auth::id() == $profile->user_id)
<a href="/edit/profile">Редактировать</a>
@endif