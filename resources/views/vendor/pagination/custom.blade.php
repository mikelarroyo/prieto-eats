@if ($paginator->hasPages())
    <nav aria-label="Paginación" class="mt-4">
        <ul class="pagination justify-content-center">

            {{-- Anterior --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link"><i class="fas fa-chevron-left" style="font-size:.7rem;"></i></span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fas fa-chevron-left" style="font-size:.7rem;"></i>
                    </a>
                </li>
            @endif

            {{-- Números de página --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Siguiente --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="fas fa-chevron-right" style="font-size:.7rem;"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link"><i class="fas fa-chevron-right" style="font-size:.7rem;"></i></span>
                </li>
            @endif

        </ul>

        <p class="text-center mt-2" style="font-size:.8rem; color:var(--pe-muted);">
            Página {{ $paginator->currentPage() }} de {{ $paginator->lastPage() }}
            &nbsp;·&nbsp;
            {{ $paginator->total() }} pedidos en total
        </p>
    </nav>
@endif
