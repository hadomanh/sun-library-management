@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <fieldset disabled="disabled">
                    <form method="POST" action="{{ route('user.update', ['user' => Auth::user()]) }}"
                        enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                            <label for="from" class="col-md-1 col-form-label text-md-right">{{ __('From') }}</label>
                            <div class="col-md-3">
                                <input id="from" type="date" class="form-control" name="from" value="{{ $order->from }}">
                            </div>
                            <label for="to" class="col-md-1 col-form-label text-md-right">{{ __('To') }}</label>
                            <div class="col-md-3">
                                <input id="to" type="date" class="form-control" name="to" value="{{ $order->to }}">
                            </div>
                            <label for="status" class="col-md-1 col-form-label text-md-right">{{ __('Status') }}</label>
                            <div class="col-md-3">
                                <div id="status" class="form-control">{{ __($order->status ? 'Approved' : 'Pending') }}</div>
                            </div>
                        </div>
                    </form>
                </fieldset>
            </div>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Authors') }}</th>
                        <th>{{ __('Publisher') }}</th>
                        <th>{{ __('Categories') }}</th>
                        <th>{{ __('Rating') }}</th>
                        <th>{{ __('Quantity') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->books as $book)
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td>
                                <a href="{{ route('books.show', ['book' => $book]) }}">{{ $book->title }}</a>
                            </td>
                            <td>
                                {{ $book->authors->shuffle()->first()->name }}
                                @if ($book->authors->count() > 1)
                                    <em>et al.</em>
                                @endif
                            </td>
                            <td>{{ $book->publisher->name }}</td>
                            <td>
                                @foreach ($book->categories as $category)
                                    <div class="badge badge-secondary">{{ ucfirst($category->name) }}</div>
                                @endforeach
                            </td>
                            <td>{{ number_format($book->ratingsAndComments->avg('pivot.rating'), 1) }}</td>
                            <td>{{ $book->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="form-group row mb-0 justify-content-center">
                <a class="btn btn-primary" href="{{ route('book_orders.edit', ['book_order' => $order]) }}">{{ __('Edit') }}</a>
            </div>
        </div>
    </div>
@endsection
