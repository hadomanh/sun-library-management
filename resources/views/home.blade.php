@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Authors') }}</th>
                            <th>{{ __('Publisher') }}</th>
                            <th>{{ __('Categories') }}</th>
                            <th>{{ __('Pages') }}</th>
                            <th>{{ __('Quantity') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr data-widget="expandable-table" aria-expanded="false">
                                <td>{{ $book->title }}</td>
                                <td>
                                    @foreach ($book->authors as $author)
                                        {{ $author->name }}<br/>
                                    @endforeach
                                </td>
                                <td>{{ $book->publisher->name }}</td>
                                <td>
                                    @foreach ($book->categories as $category)
                                        {{ $category->name }}<br/>
                                    @endforeach
                                </td>
                                <td>{{ $book->number_of_pages }}</td>
                                <td>{{ $book->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                @include('pagination.default', ['paginator' => $books])
            </div>
        </div>
    @endsection
