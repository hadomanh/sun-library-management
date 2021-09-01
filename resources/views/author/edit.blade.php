@extends('layouts.admin')

@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Edit Author</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{ route('authors.update', $author->id) }}" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                        <div class="col-8">
                            <input type="text" name="name" class="form-control" placeholder="Author name..." value="{{ $author->name }}" required>
                        </div>

                        <div class="col-2">
                            <button type="submit" class="btn btn-block btn-outline-warning">Save change</button>
                        </div>

                        <div class="col-2">
                            <a href="{{ route('authors.index') }}" class="btn btn-block btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label>Books:</label>
                        @foreach ($books as $book)
                        <div class="custom-control custom-checkbox">
                            @if (array_search($book->id, array_column($author->books->toArray(), 'id')) !== false)
                                <input class="custom-control-input" type="checkbox" id="{{ 'customCheckbox' . $book->id }}" name="books[]" value="{{ $book->id }}" checked>
                            @else
                                <input class="custom-control-input" type="checkbox" id="{{ 'customCheckbox' . $book->id }}" name="books[]" value="{{ $book->id }}">
                            @endif
                            
                            <label for="{{ 'customCheckbox' . $book->id }}" class="custom-control-label">{{ $book->title }}</label>
                        </div>
                        @endforeach
                    </div>
              </div>

            </div>

        </div>
        <!-- /.card-body -->
    </form>
</div>    
@endsection
