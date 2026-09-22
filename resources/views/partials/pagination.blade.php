@if ($paginator->hasPages())
    <nav class="pagination-nav" aria-label="Pagination Navigation">
        <ul class="pagination-list">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-item pagination-item--disabled" aria-disabled="true" aria-label="Previous Page">
                    <span class="pagination-link">&larr; Previous</span>
                </li>
            @else
                <li class="pagination-item">
                    <a href="{{ $paginator->previousPageUrl() }}" class="pagination-link" rel="prev" aria-label="Previous Page">&larr; Previous</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="pagination-item pagination-item--disabled" aria-disabled="true">
                        <span class="pagination-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination-item pagination-item--active" aria-current="page">
                                <span class="pagination-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="pagination-item">
                                <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pagination-item">
                    <a href="{{ $paginator->nextPageUrl() }}" class="pagination-link" rel="next" aria-label="Next Page">Next &rarr;</a>
                </li>
            @else
                <li class="pagination-item pagination-item--disabled" aria-disabled="true" aria-label="Next Page">
                    <span class="pagination-link">Next &rarr;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
