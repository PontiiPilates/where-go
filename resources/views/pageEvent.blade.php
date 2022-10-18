{{-- Layout --}}
<x-layout :localstorage="$localstorage">

  {{-- Страница события --}}
  <x-page_event :event="$event"></x-page_event>

  {{-- @include('components.test', ['comments' => $comment->comments, 'post_id' => $comment->id]) --}}

  @foreach($comments as $comment)

                  @include('components.test', ['comments' => $comment->comments, 'post_id' => $comment->id])
 
@endforeach


  {{-- Комментарии --}}
  <ul class="list-group mb-3">
    @foreach ($comments as $comment)
    <li class="list-group-item d-flex justify-content-between align-items-start">
      <div class="ms-2 me-auto">
        <div class="fw-bold">{{ $comment->user_id }}</div>
        {{ $comment->comment }}
      </div>
      <small>{{ $comment->created_at }}</small>
    </li>
    @endforeach
  </ul>

  {{-- Оставить комментарий --}}
  <form method="POST" action="">

    {{-- CSFR --}}
    @csrf

    <div class="mb-3">
      <label for="comment" class="form-label">{{ __('Комментарий') }}</label>
      <input name="comment" type="comment" class="form-control @error('comment') is-invalid @enderror" id="comment"
        value="{{ old('comment') }}">
      @error('comment')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div>
      <button type="submit" class="btn btn-warning w-100">{{ __('Оставить комментарий') }}</button>
    </div>

  </form>


@foreach($comments as $comment)

<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-body">
                  <h3 class="text-center text-primary">MyWebtuts.com</h3>
                  <hr />
                  <br/>
                  <h3>{{ $comment->title }}</h3>
                  <p>
                      {{ $comment->comment }}
                  </p>
                  <hr />
                  <h4>Display Comments</h4>

                  <hr />
                  @include('components.test', ['comments' => $comment->comments, 'post_id' => $comment->id])
 
                  <h4>Add comment</h4>
                  <form method="post" action="#">
                      @csrf
                      <div class="form-group">
                          <textarea class="form-control" name="body"></textarea>
                          <input type="hidden" name="post_id" value="{{ $comment->id }}" />
                      </div>
                      <div class="form-group">
                          <input type="submit" class="btn btn-primary" value="Add Comment" />
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
@endforeach


</x-layout>