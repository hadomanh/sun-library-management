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
          <button id="deleteConfirm" type="button" class="btn btn-danger">Delete permanently</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create Publisher</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{ route('api.publisher.create') }}" autocomplete="off">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <div class="col-9">
                    <input type="text" name="name" class="form-control" id="categoryName" placeholder="Publisher name...">
                </div>

                <div class="col-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
            </div>
        </div>
        <!-- /.card-body -->
    </form>
</div>

<div class="card">
    <div class="card-header">
      <h3 class="card-title">Publishers</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-striped">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Name</th>
            <th>Books</th>
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
                          <a href="#" class="btn btn-outline-primary">{{ $book->title }}</a>
                      @endforeach
                    </td>
                    <td>
                        <div class="btn btn-outline-danger deleteItemBtn" data-url="{{ route('api.publisher.delete', $publisher->id) }}" data-toggle="modal" data-target="#modal-default">
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

