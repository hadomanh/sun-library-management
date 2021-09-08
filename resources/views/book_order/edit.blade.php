@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('book_orders.update', ['book_order' => $order]) }}"
                            enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="form-group row">
                                <label for="from" class="col-md-2 col-form-label text-md-right">{{ __('From') }}</label>
                                <div class="col-md-4">
                                    <input id="from" type="date" class="form-control" name="from"
                                        value="{{ $order->from }}">
                                </div>
                                <label for="to" class="col-md-2 col-form-label text-md-right">{{ __('To') }}</label>
                                <div class="col-md-4">
                                    <input id="to" type="date" class="form-control" name="to" value="{{ $order->to }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="books">{{ __('Books') }}</label>
                                <select multiple class="form-control" id="books" size="20" name="books[]">
                                    @foreach ($availables as $book)
                                        @if ($order->books->contains($book->id))
                                            <option value="{{ $book->id }}" selected>{{ $book->title }}</option>
                                        @else
                                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group row mb-0 justify-content-center">
                                <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
