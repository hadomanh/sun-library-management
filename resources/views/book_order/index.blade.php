@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-12 px-0 mb-3">
            <button class="btn btn-primary" id="filterBtn" data-toggle="modal" data-target="#filterFormModal">
                {{ __('Add') }}
            </button>
            <div class="modal fade" id="filterFormModal" tabindex="-1" role="dialog"
                aria-labelledby="filterFormModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="filterFormModalLabel">
                                {{ __('Add Orders') }}
                            </h5>
                        </div>
                        <div class="modal-body">
                            <form id="bookFilterForm" action="{{ route('book_orders.store') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="from" class="col-md-4 col-form-label text-md-right">{{ __('From') }}</label>
                                    <div class="col-md-6">
                                        <input id="from" type="date" class="form-control" name="from" value="{{ \Carbon\Carbon::now() }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="to" class="col-md-4 col-form-label text-md-right">{{ __('To') }}</label>
                                    <div class="col-md-6">
                                        <input id="to" type="date" class="form-control" name="to" value="{{ \Carbon\Carbon::now() }}">
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
                    <th>{{ __('#') }}</th>
                    <th>{{ __('From') }}</th>
                    <th>{{ __('To') }}</th>
                    <th>{{ __('Books') }}</th>
                    <th>{{ __('Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>
                            <a href="{{ route('book_orders.show', ['book_order' => $order]) }}">{{ $order->id }}</a>
                        </td>
                        <td>{{ $order->from }}</td>
                        <td>{{ $order->to }}</td>
                        <td>{{ $order->books_count }}</td>
                        <td>{{ $order->status == 1 ? __('Approved') : __('Pending') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        {{-- @include('pagination.default', ['paginator' => $orders]) --}}
    </div>
@endsection
