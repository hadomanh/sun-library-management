@if ($paginator->total() > $paginator->perPage())
<div class="row">
    <div class="col-sm-12 col-md-5">
      <div class="dataTables_info">Showing {{ $paginator->firstItem() }} to {{ $paginator->firstItem() + $paginator->count() - 1 }}  of {{ $paginator->total() }} entries</div>
    </div>

    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers">
            <ul class="pagination">
                <li class="paginate_button page-item previous {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                    <a href="{{ $paginator->url($paginator->currentPage() - 1) }}" class="page-link">Previous</a>
                </li>

                @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                    <li class="paginate_button page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                        <a href="{{ $paginator->url($i) }}" class="page-link">{{ $i }}</a>
                    </li>
                @endfor

                <li class="paginate_button page-item next {{ ($paginator->hasMorePages()) ? ' ' : 'disabled' }}">
                    <a href="{{ $paginator->url($paginator->currentPage() + 1) }}" class="page-link">Next</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endif