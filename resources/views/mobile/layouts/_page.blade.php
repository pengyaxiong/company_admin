@if ($paginator->hasPages())

    <div class="pagination doctorPagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li ><a href="#">第一页</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}">上一页</a>
        @endif
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a class="paginationOn">{{ $element }}</a>
            @endif
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="paginationOn">{{ $page }}</a>
                    @else
                        <a class="paginationOn" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">下一页</a>
        @else
            <a href="#">最后一页</a>
        @endif
    </div>
@endif


{{--{!! $solutions->appends(Request::all())->links('home.layouts._page') !!}--}}