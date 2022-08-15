{{-- {{ dd($item) }} --}}
<p class="card-text">
    <a href="/?selector={{ $item->category}}" class="text-reset">
        <small class="text-muted">
            {{ $item->category}}
        </small>
    </a>
</p>