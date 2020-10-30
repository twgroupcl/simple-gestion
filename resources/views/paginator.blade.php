@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        <ul class="pagination paginator-right">
            @if ($paginator->onFirstPage())
                <li class="page-item d-sm-none">
                    <span class="page-link page-link-static"></span>
                </li>
            @else
                <li class="page-item">
                    <a wire:click="previousPage" class="page-link"><i class="czi-arrow-left"></i></a>
                </li>
            @endif
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif
                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li wire:key="paginator-page-{{ $page }}"  class="page-item active d-none d-sm-block" aria-current="page">
                                    <span class="page-link">
                                        {{ $page }}
                                        <span class="sr-only">(current)</span>
                                    </span>
                                </li>
                            @else
                                <li class="page-item d-none d-sm-block">
                                    <a type="button" class="page-link" wire:click="gotoPage({{ $page }})">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
    
            @endforeach
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a wire:click="nextPage" class="page-link"><i class="czi-arrow-right"></i></a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link"><i class="czi-arrow-right"></i></a>
                </li>
            @endif
        </ul>
    </nav>
@endif
