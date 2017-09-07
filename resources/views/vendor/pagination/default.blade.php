@if ($paginator->hasPages())
    <div class="center">
        <ul class="pagination">
            <!-- Previous Page Link -->
            @if ($paginator->onFirstPage())
                <li class="disabled hide"><i class="fas fa-angle-left" aria-hidden="true"></i></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fas fa-angle-left"
                                                                                aria-hidden="true"></i> </a>
                </li>
            @endif
        <!-- Pagination Elements -->
            @foreach ($elements as $element)
            <!-- "Three Dots" Separator -->
                @if (is_string($element))
                    <li class="hide-on-med-and-down">{{ $element }}</li>
                @endif
            <!-- Array Of Links -->
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a>{{ $page }}</a></li>
                        @else
                            <li class="waves-effect hide-on-med-and-down"><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        <!-- Next Page Link -->
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fas fa-angle-right"
                                                                            aria-hidden="true"></i> </a>
                </li>
            @else
                <li class="disabled hide"><i class="fas fa-angle-right" aria-hidden="true"></i></li>
            @endif
        </ul>
    </div>
@endif
