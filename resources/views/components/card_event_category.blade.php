<p class="card-text">
    <small class="text-muted">

        @foreach( $item->category as $category )
            <a href="" class="text-reset">{{ $category }}</a>
            @unless($loop->last) | @endunless
        @endforeach

    </small>
</p>