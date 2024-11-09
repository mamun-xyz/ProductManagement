@if ($paginator->onFirstPage())
    <span class="page-item disabled"><span class="page-link">« Previous</span></span>
@else
    <a class="page-item" href="{{ $paginator->previousPageUrl() }}"><span class="page-link">« Previous</span></a>
@endif

@foreach ($elements as $element)
    @if (is_array($element))
        @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
                <span class="page-item active"><span class="page-link">{{ $page }}</span></span>
            @else
                <a class="page-item" href="{{ $url }}"><span class="page-link">{{ $page }}</span></a>
            @endif
        @endforeach
    @endif
@endforeach

@if ($paginator->hasMorePages())
    <a class="page-item" href="{{ $paginator->nextPageUrl() }}"><span class="page-link">Next »</span></a>
@else
    <span class="page-item disabled"><span class="page-link">Next »</span></span>
@endif
