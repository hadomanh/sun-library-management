@extends('layouts.admin')

@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create Author</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{ route('author.store') }}" autocomplete="off">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                        <div class="col-8">
                            <input type="text" name="name" class="form-control" placeholder="Author name..." required>
                        </div>

                        <div class="col-2">
                            <button type="submit" class="btn btn-block btn-primary">Submit</button>
                        </div>

                        <div class="col-2">
                            <a href="{{ route('author.index') }}" class="btn btn-block btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label>Books:</label>
                        @foreach ($books as $book)
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="{{ 'customRadio' . $book->id }}" name="book_id" value="{{ $book->id }}">
                            <label for="{{ 'customRadio' . $book->id }}" class="custom-control-label">{{ $book->title }}</label>
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
