<ul class="pagination">
    {{-- Previous Page Link --}}
    @if ($datas->onFirstPage())
        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
    @else
        <li class="page-item"><a class="page-link" href="{{ $datas->previousPageUrl() }}" rel="prev">&laquo;</a></li>
    @endif

    @php
        $firstPage = 1;
        $iterate = $datas->lastPage();
        $totalPages = $datas->lastPage();

        if ($totalPages > 5) {
            if ($datas->currentPage() >= 3 && $datas->currentPage() < $totalPages - 2) {
                $firstPage = $datas->currentPage() - 2;
                $iterate = $datas->currentPage() + 2;
            } elseif ($datas->currentPage() >= $totalPages - 2) {
                $firstPage = $totalPages - 4;
                $iterate = $totalPages;
            } else {
                $iterate = 5;
            }
        }
    @endphp

    {{-- Pagination Elements --}}
    @for ($page = $firstPage; $page <= $iterate; $page++)
        @if ($page == $datas->currentPage())
            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $datas->url($page) }}">{{ $page }}</a></li>
        @endif
    @endfor

    {{-- Next Page Link --}}
    @if ($datas->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $datas->nextPageUrl() }}" rel="next">&raquo;</a></li>
    @else
        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
    @endif
    <div class="text-medium-sh6 text-neutral-gray-20 mt-2 ms-3">
        @if ($datas->firstItem())
            {{ $datas->firstItem() }} - {{ $datas->lastItem() }}
        @else
            {{ $datas->count() }}
        @endif 
        From {{ $datas->total() }}
    </div>

</ul>
