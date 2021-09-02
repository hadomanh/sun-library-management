@extends('layouts.admin')

@section('content')
<div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title">Books</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <form action="{{ route('books.store') }}" method="POST" autocomplete="off">
        @csrf
        <div class="row">
            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Title') }}:</label>
                <input type="text" name="title" class="form-control" placeholder="Title ..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Number of pages') }}:</label>
                <input type="number" name="number_of_pages" class="form-control" placeholder="Number of pages ..." required>
              </div>
            </div>

            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>{{ __('Quantity') }}:</label>
                <input type="number" name="quantity" class="form-control" placeholder="Quantity ..." required>
              </div>
            </div>
        </div>

        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label>{{ __('Authors') }}:</label>
              <div class="select2-indigo">
                <select class="select2" name="authors[]" multiple="multiple" data-placeholder="Select authors" data-dropdown-css-class="select2-indigo" style="width: 100%;" required>
                  @foreach ($authors as $author)
                      <option value="{{ $author->id }}">{{ $author->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              <label>{{ __('Categories') }}:</label>
              <div class="select2-maroon">
                <select class="select2" name="categories[]" multiple="multiple" data-placeholder="Select categories" data-dropdown-css-class="select2-maroon" style="width: 100%;" required>
                  @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              <label>{{ __('Publisher') }}</label>
              <select name="publisher_id" class="form-control select2 select2-lightblue" data-dropdown-css-class="select2-lightblue" style="width: 100%;" required>
                @foreach ($publishers as $publisher)
                    <option value="{{ $publisher->id }}" {{ $loop->index === count($publishers) ? 'selected' : '' }}>{{ $publisher->name }}</option>
                @endforeach
              </select>
            </div>
            <!-- /.form-group -->
          </div>
        </div>

        <div class="row">
            <div class="col-3"></div>
            <button class="btn btn-primary col-6" type="submit">{{ __('Submit') }}</button>
        </div>
        <br>
        <div class="row">
            <div class="col-3"></div>
            <a class="btn btn-outline-secondary col-6" href="{{ route('books.index') }}">{{ __('Cancel') }}</a>
        </div>

      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection