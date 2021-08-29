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
          <button id="deleteConfirm" type="button" class="btn btn-danger">">{{ __('Delete permanently') }}</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

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
                    <td>{{ $author->book->title }}</td>
                    <td>
                      <a class="btn btn-outline-warning" href="{{ route('author.edit', $author->id) }}">
                        <i class="fas fa-edit"></i> Edit
                      </a>
                      <div class="btn btn-outline-danger deleteItemBtn" data-url="{{ route('api.author.destroy', $author->id) }}" data-toggle="modal" data-target="#modal-default">
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

