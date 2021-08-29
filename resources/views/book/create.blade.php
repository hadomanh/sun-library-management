@extends('layouts.admin')

@section('content')
<div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title">Books</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <form action="{{ route('book.store') }}" method="POST" autocomplete="off">
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
          <div class="col-sm-6">
            <!-- checkbox -->
            <div class="form-group">
                <label>{{ __('Categories') }}:</label>
                @foreach ($categories as $category)
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="{{ 'customCheckbox' . $category->id }}" name="categories[]" value="{{ $category->id }}">
                        <label for="{{ 'customCheckbox' . $category->id }}" class="custom-control-label">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>
          </div>
          <div class="col-sm-6">
            <!-- radio -->
            <div class="form-group">
                <label>{{ __('Publishers') }}:</label>
                @foreach ($publishers as $publisher)
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="{{ 'customRadio' . $publisher->id }}" name="publisher_id" value="{{ $publisher->id }}">
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
        <br>
        <div class="row">
            <div class="col-3"></div>
            <a class="btn btn-outline-secondary col-6" href="{{ route('book.index') }}">{{ __('Cancel') }}</a>
        </div>

      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection