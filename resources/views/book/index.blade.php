@extends('layouts.admin')

@section('content')
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{ __('Confirm delete?') }}</h4>
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

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ __('Books') }}</h3>
    </div>
    <!-- ./card-header -->
    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>{{ __('Title') }}</th>
            <th>{{ __('Number of pages') }}</th>
            <th>{{ __('Quantity') }}</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr data-widget="expandable-table" aria-expanded="false">
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->number_of_pages}}</td>
                <td>{{ $book->quantity }}</td>
                <td>
                  <a href="{{ route('books.edit', $book->id) }}" class="btn btn-outline-warning">
                    <i class="fas fa-edit"></i> 
                    {{ __('Edit') }}
                  </a>
                  
                  <div class="btn btn-outline-danger deleteItemBtn" data-url="{{ route('api.books.destroy', $book->id) }}" data-toggle="modal" data-target="#modal-default">
                    <i class="fas fa-trash"></i> 
                    {{ __('Delete') }}
                  </div>

                </td>
              </tr>
              <tr class="expandable-body">
                <td colspan="5">
                    <p>
                      <b>{{ __('Categories') }}: </b>
                      @foreach ($book->categories as $category)
                          <a href="{{ route('categories.index') }}" class="btn btn-outline-primary">{{ $category->name }}</a>
                      @endforeach
                    <br><br>
                      <b>{{ __('Authors') }}: </b>
                      @foreach ($book->authors as $author)
                          <a href="{{ route('authors.index') }}" class="btn btn-outline-warning">{{ $author->name }}</a>
                      @endforeach
                    </p>
                </td>
              </tr>
            @endforeach
          
        </tbody>
      </table>
      <br>
      @include('pagination.default', ['paginator' => $books])
    </div>
    <!-- /.card-body -->
  </div>
@endsection

