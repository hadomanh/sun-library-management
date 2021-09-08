@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-12 px-0 mb-3">
                <button class="btn btn-primary" id="filterBtn" data-toggle="modal" data-target="#filterFormModal">
                    {{ __('Filter') }}
                </button>
                <div class="modal fade" id="filterFormModal" tabindex="-1" role="dialog"
                    aria-labelledby="filterFormModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="filterFormModalLabel">
                                    {{ __('Filter') }}
                                </h5>
                            </div>
                            <div class="modal-body">
                                <form id="bookFilterForm" action="{{ route('books.filter') }}" method="get">
                                    <div class="form-group row">
                                        <label for="titleFilter" class="col-form-label col-sm-3">
                                            {{ __('Title') }}
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="titleFilter" name="title" class="form-control"
                                                placeholder="Un Coloquam Facet">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="authorFilter" class="col-form-label col-sm-3">
                                            {{ __('Author') }}
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="authorFilter" name="author" class="form-control"
                                                placeholder="Joe Smith">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="publisherFilter" class="col-form-label col-sm-3">
                                            {{ __('Publisher') }}
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="publisherFilter" name="publisher"
                                                class="form-control" placeholder="Alloy Inc.">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="categoryFilter" class="col-form-label col-sm-3">
                                            {{ __('Category') }}
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="categoryFilter" name="category" class="form-control"
                                                placeholder="{{ __('Enter categories, separated by spaces') }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3">
                                            {{ __('Rating') }}
                                        </label>
                                        <div class="col-sm-4">
                                            <input type="number" id="maxRatingFilter" name="rating[0]" min="1" max="5"
                                                placeholder="1" class="form-control">
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-4">
                                            <input type="number" id="maxRatingFilter" name="rating[1]" min="1" max="5"
                                                placeholder="5" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
                    @foreach ($books as $book)
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
            <br>
            @include('pagination.default', ['paginator' => $books])
        </div>
    @endsection
