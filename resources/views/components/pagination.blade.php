<footer class="card-footer">
    <div class="card-footer-item">
        <div class="pagination-wrapper">
            <nav class="pagination is-centered" role="navigation" aria-label="pagination">

                {{-- Previous Page --}}
                @if ($model->onFirstPage())
                    <a class="pagination-previous" disabled title="Previous page">
                        <span class="icon"><i class="fas fa-arrow-left"></i></span>
                    </a>
                @else
                    <a class="pagination-previous" href="{{ $model->previousPageUrl() }}" title="Previous page">
                        <span class="icon"><i class="fas fa-arrow-left"></i></span>
                    </a>
                @endif

                {{-- Next Page --}}
                @if ($model->hasMorePages())
                    <a class="pagination-next" href="{{ $model->nextPageUrl() }}" title="Next page">
                        <span class="icon"><i class="fas fa-arrow-right"></i></span>
                    </a>
                @else
                    <a class="pagination-next" disabled title="Next page">
                        <span class="icon"><i class="fas fa-arrow-right"></i></span>
                    </a>
                @endif

                {{-- Page Numbers --}}
                <ul class="pagination-list">
                    @for ($i = 1; $i <= $model->lastPage(); $i++)
                        @if ($i == $model->currentPage())
                            <li>
                                <a class="pagination-link is-current" aria-label="Page {{ $i }}">{{ $i }}</a>
                            </li>
                        @else
                            <li>
                                <a class="pagination-link" href="{{ $model->url($i) }}" aria-label="Page {{ $i }}">{{ $i }}</a>
                            </li>
                        @endif
                    @endfor
                </ul>

            </nav>
        </div>
    </div>
</footer>

