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

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Expandable Table</h3>
    </div>
    <!-- ./card-header -->
    <div class="card-body">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Number of pages</th>
            <th>Quantity</th>
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
                  <a href="{{ route('book.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                  
                  <div class="btn btn-danger deleteItemBtn" data-url="{{ route('api.book.destroy', $book->id) }}" data-toggle="modal" data-target="#modal-default">Delete</div>
                </td>
              </tr>
              <tr class="expandable-body">
                <td colspan="5">
                    <p>
                      <b>Categories: </b>
                      @foreach ($book->categories as $category)
                          <a class="btn btn-outline-primary">{{ $category->name }}</a>
                      @endforeach
                    <br>
                      <b>Authors: </b>
                      @foreach ($book->authors as $author)
                          <a class="btn btn-outline-warning">{{ $author->name }}</a>
                      @endforeach
                    </p>
                </td>
              </tr>
            @endforeach
          
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection

