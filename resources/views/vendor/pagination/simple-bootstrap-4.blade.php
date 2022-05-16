@if ($paginator->hasPages())
<nav>
    <ul class="pagination justify-content-between gap-3">

        @if ($paginator->hasMorePages())
        <!-- Есть ли еще элементы в хранилище данных? -->

            @if ($paginator->onFirstPage())
            <!-- Находится ли пагинатор на первой странице? -->

            <li class="page-item flex-fill">
                <a class="page-link rounded text-center" href="{{ $paginator->nextPageUrl() }}" rel="next">{{ __('Еще') }}</a>
            </li>

            @else
            <!-- Пагинатор находится не на первой странице -->

            <li class="page-item flex-grow-3">
                <a class="page-link rounded text-center" href="{{ $paginator->previousPageUrl() }}" rel="prev">{{ __('Назад') }}</a>
            </li>
            <li class="page-item flex-grow-1">
                <a class="page-link rounded text-center" href="{{ $paginator->nextPageUrl() }}" rel="next">{{ __('Еще') }}</a>
            </li>

            @endif

        @else
        <!-- Пагинатор находится на последней странице -->

        <li class="page-item flex-fill" aria-disabled="true">
            <a class="page-link rounded text-center" href="{{ $paginator->previousPageUrl() }}" rel="prev">{{ __('Назад') }}</a>
        </li>

        @endif

    </ul>
</nav>
@endif