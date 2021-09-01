@extends('layouts.admin')

@section('content')
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirm delete?</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
    <h3 class="card-title">Create Author</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form method="POST" action="{{ route('authors.store') }}" autocomplete="off">
    @csrf
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <div class="form-group row">
            <div class="col-9">
              <input type="text" name="name" class="form-control" placeholder="Author name..." required>
            </div>

            <div class="col-3">
              <button type="submit" class="btn btn-block btn-primary">Submit</button>
            </div>
          </div>
        </div>

      </div>

    </div>
<!-- /.card-body -->
</form>
</div>    

<div class="card">
    <div class="card-header">
      <h3 class="card-title">Authors</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-striped">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Name</th>
            <th>Book</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($authors as $author)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $author->name }}</td>
                    <td>
                      @foreach ($author->books as $book)
                        <a href="{{ route('books.index') }}">{{ $book->title }}</a>
                        {{ $loop->index + 1 === count($author->books) ? '' : ',' }}
                        @if ($loop->index + 1 === 3 && $loop->index + 1 < count($author->books))
                            {{ '...' }}
                            @break
                        @endif
                      @endforeach
                    </td>
                    <td>
                      <a class="btn btn-outline-warning" href="{{ route('authors.edit', $author->id) }}">
                        <i class="fas fa-edit"></i> Edit
                      </a>
                      <div class="btn btn-outline-danger deleteItemBtn" data-url="{{ route('api.authors.destroy', $author->id) }}" data-toggle="modal" data-target="#modal-default">
                        <i class="fas fa-trash"></i> Delete
                      </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection

