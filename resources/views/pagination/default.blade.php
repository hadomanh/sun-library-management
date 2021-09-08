@if ($paginator->total() > $paginator->perPage())
    <div class="dataTables_paginate paging_simple_numbers">
        <ul class="pagination">
            <li class="paginate_button page-item first {{ $paginator->currentPage() == 1 ? ' disabled' : '' }}">
                <a href="{{ $paginator->url(1) }}" class="page-link">{{ __('First') }}</a>
            </li>

            <li class="paginate_button page-item previous {{ $paginator->currentPage() == 1 ? ' disabled' : '' }}">
                <a href="{{ $paginator->previousPageUrl() }}" class="page-link">{{ __('Previous') }}</a>
            </li>

            @for ($i = max(1, $paginator->currentPage() - 3); $i <= min($paginator->lastPage(), $paginator->currentPage() + 3); $i++)
                <li class="paginate_button page-item {{ $paginator->currentPage() == $i ? ' active' : '' }}">
                    <a href="{{ $paginator->url($i) }}" class="page-link">{{ $i }}</a>
                </li>
            @endfor

            <li class="paginate_button page-item next {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                <a href="{{ $paginator->nextPageUrl() }}" class="page-link">{{ __('Next') }}</a>
            </li>

            <li class="paginate_button page-item last {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                <a href="{{ $paginator->url($paginator->lastPage()) }}" class="page-link">{{ __('Last') }}</a>
            </li>
        </ul>
    </div>
@endif
