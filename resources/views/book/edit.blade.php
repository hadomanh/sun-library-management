@extends('layouts.admin')

@section('content')
<div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title">Books</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <form action="{{ route('books.update', $book->id) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Title') }}:</label>
                <input type="text" name="title" class="form-control" placeholder="Title ..." value="{{ $book->title }}" required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Number of pages') }}:</label>
                <input type="number" name="number_of_pages" class="form-control" placeholder="Number of pages ..." value="{{ $book->number_of_pages }}" required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Quantity') }}:</label>
                <input type="number" name="quantity" class="form-control" placeholder="Quantity ..." value="{{ $book->quantity }}" required>
              </div>
            </div>
        </div>

        <div class="row">
          <div class="col-sm-4">
            <!-- checkbox -->
            <div class="form-group">
                <label>{{ __('Authors') }}:</label>

                @foreach ($authors as $author)
                    <div class="custom-control custom-checkbox">
                      @if (array_search($author->id, array_column($book->authors->toArray(), 'id')) !== false)
                        <input class="custom-control-input" type="checkbox" id="{{ 'authorCheckbox' . $author->id }}" name="authors[]" value="{{ $author->id }}" checked>
                      @else
                        <input class="custom-control-input" type="checkbox" id="{{ 'authorCheckbox' . $author->id }}" name="authors[]" value="{{ $author->id }}">
                      @endif
                        <label for="{{ 'authorCheckbox' . $author->id }}" class="custom-control-label">{{ $author->name }}</label>
                    </div>
                @endforeach
            </div>
          </div>

          <div class="col-sm-4">
            <!-- checkbox -->
            <div class="form-group">
                <label>{{ __('Categories') }}:</label>

                @foreach ($categories as $category)
                    <div class="custom-control custom-checkbox">
                      @if (array_search($category->id, array_column($book->categories->toArray(), 'id')) !== false)
                        <input class="custom-control-input" type="checkbox" id="{{ 'categoryCheckbox' . $category->id }}" name="categories[]" value="{{ $category->id }}" checked>
                      @else
                        <input class="custom-control-input" type="checkbox" id="{{ 'categoryCheckbox' . $category->id }}" name="categories[]" value="{{ $category->id }}">
                      @endif
                        <label for="{{ 'categoryCheckbox' . $category->id }}" class="custom-control-label">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>
          </div>

          <div class="col-sm-4">
            <!-- radio -->
            <div class="form-group">
                <label>{{ __('Publishers') }}:</label>

                @foreach ($publishers as $publisher)
                    <div class="custom-control custom-radio">
                      @if ($book->publisher_id == $publisher->id)
                        <input class="custom-control-input" type="radio" id="{{ 'customRadio' . $publisher->id }}" name="publisher_id" value="{{ $publisher->id }}" checked>
                      @else
                        <input class="custom-control-input" type="radio" id="{{ 'customRadio' . $publisher->id }}" name="publisher_id" value="{{ $publisher->id }}">
                      @endif
                        
                        <label for="{{ 'customRadio' . $publisher->id }}" class="custom-control-label">{{ $publisher->name }}</label>
                    </div>
                @endforeach
            </div>
          </div>
        </div>

        <div class="row">
            <div class="col-3"></div>
            <button class="btn btn-primary col-6" type="submit">{{ __('Submit') }}</button>
        </div>

      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection