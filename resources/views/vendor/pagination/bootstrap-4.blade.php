@if ($paginator->hasPages())
    <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
            {{-- Previous Page Link --}}
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="page-item"><a class="page-link"><i class="czi-arrow-left mr-2"></i>Anterior</a></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="czi-arrow-left mr-2"></i>Anterior</a></li>
            @endif
        </ul>

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <ul class="pagination">
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    </ul>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    <ul class="pagination">
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            @endforeach

            {{-- Next Page Link --}}
        <ul class="pagination">
            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">Siguiente<i class="czi-arrow-right ml-2"></i></a></li>
            @else
                <li class="page-item"><a class="page-link" aria-label="Next">Siguiente<i class="czi-arrow-right ml-2"></i></a></li>
            @endif
        </ul>
    </nav>
@endif
