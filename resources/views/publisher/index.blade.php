@extends('layouts.admin')

@section('content')
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{ __('Confirm delete') }}?</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
          <button id="deleteConfirm" type="button" class="btn btn-danger">{{ __('Delete permanently') }}</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">{{ __('Create Publisher') }}</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{ route('api.publishers.create') }}" autocomplete="off">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <div class="col-9">
                    <input type="text" name="name" class="form-control" id="categoryName" placeholder="Publisher name...">
                </div>

                <div class="col-3">
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
                
            </div>
        </div>
        <!-- /.card-body -->
    </form>
</div>

<div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ __('Publishers') }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-striped">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Books') }}</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($publishers as $publisher)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $publisher->name }}</td>
                    <td>
                      @foreach ($publisher->books as $book)
                        <a href="{{ route('books.index') }}">{{ $book->title }}</a>
                        {{ $loop->index + 1 === count($publisher->books) ? '' : ',' }}
                        @if ($loop->index + 1 === 3 && $loop->index + 1 < count($publisher->books))
                            {{ '...' }}
                            @break
                        @endif
                      @endforeach
                    </td>
                    <td>
                        <div class="btn btn-outline-danger deleteItemBtn" data-url="{{ route('api.publishers.delete', $publisher->id) }}" data-toggle="modal" data-target="#modal-default">
                          <i class="fas fa-trash"></i> {{ __('Delete') }}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    <br>
    <div class="ml-5">
      @include('pagination.default', ['paginator' => $publishers])
    </div>
</div>
@endsection

