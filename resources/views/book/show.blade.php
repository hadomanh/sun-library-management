<?php
$avgRating = $book->ratingsAndComments->avg('pivot.rating');
?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container-fluid mb-3">
            <h1>{{ $book->title }}</h1>
            <div><strong>{{ __('Publisher') }}: </strong>{{ $book->publisher->name }}</div>
            <div>
                <strong>{{ __('Author(s)') }}: </strong>
                @foreach ($book->authors as $author)
                    {{ $author->name }}@if (!$loop->last), @endif
                @endforeach
            </div>
            <div><strong>{{ __('Number of pages') }}: </strong>{{ $book->number_of_pages }}</div>
            <div><strong>{{ __('Quantity') }}: </strong>{{ $book->quantity }}</div>
            <div>
                <strong>{{ __('Categories') }}: </strong>
                @foreach ($book->categories as $category)
                    <div class="badge badge-primary">{{ $category->name }}</div>
                @endforeach
            </div>
        </div>
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col col-sm-3">
                    <h3>{{ __('Ratings') }}:</h3>
                </div>
                <div class="col col-sm align-self-center text-right">
                    <h3>
                        @for ($i = 0; $i < 5; $i++)
                            @if ($i * 2 < round($avgRating * 2))
                                @if ($i * 2 + 1 < round($avgRating * 2))
                                    <div class="fas fa-star" style="color: GoldenRod"></div>
                                @else
                                    <div class="fas fa-star-half-alt" style="color: GoldenRod"></div>
                                @endif
                            @else
                                <div class="far fa-star" style="color: GoldenRod"></div>
                            @endif
                        @endfor
                        <small class="align-text-right">
                            {{ number_format($avgRating, 1) }}/5 × {{ $book->ratingsAndComments->count() }}
                        </small>
                    </h3>
                </div>
            </div>
            @foreach ($book->ratingsAndComments as $ratingAndComment)
                <div class="card my-2">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-8">
                                <h5 class="card-title my-auto">
                                    {{ $ratingAndComment->name }}
                                    @if ($ratingAndComment->is_blocked)
                                        <div class="badge badge-danger">{{ __('Banned') }}</div>
                                    @endif
                                </h5>
                            </div>
                            <div class="col-sm align-self-center text-right">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $ratingAndComment->pivot->rating)
                                        <div class="fas fa-star" style="color: GoldenRod"></div>
                                    @else
                                        <div class="far fa-star" style="color: GoldenRod"></div>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $ratingAndComment->pivot->comment }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
