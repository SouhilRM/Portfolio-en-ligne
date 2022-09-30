@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
    <ul class="pagination">

        
        {{-- 1_Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a class="page-link" href="#">
                    <i class="far fa-long-arrow-left"></i>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="far fa-long-arrow-left"></i>
                </a>
            </li>
        @endif



        {{-- 2_Pagination Elements --}}

    {{-- PAS TOUCHE --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif
    {{-- PAS TOUCHE --}}


            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())

                        {{-- ici tu touche --}}
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @else
                        <li>
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        {{-- ici tu arrete de toucher --}}
                    @endif
                @endforeach
            @endif
        @endforeach

        

        {{-- 3_Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    <i class="far fa-long-arrow-right"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <a class="page-link" href="#">
                    <i class="far fa-long-arrow-right"></i>
                </a>
            </li>
        @endif


    </ul>
    </nav>
@endif

               
          