<?php
use Illuminate\Support\Facades\Storage;
?>
@extends('layouts.app')

@section('content')

@if (isset($request))
    <pre>
        {{ print_r($request); }}
    </pre>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Personal Information') }}</div>

                <div class="card-body">
                    <fieldset disabled="disabled">
                        <form>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Profile picture') }}</label>

                                <div class="col-md-6">
                                    @if (isset($user->avatar))
                                        <img src="{{ Storage::url($user->avatar) }}" alt="" class="img-thumbnail img-fluid">
                                    @else
                                        {{ __('No avatar') }}
                                    @endif
                                </div>
                            </div>
                        </form>
                    </fieldset>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a class="btn btn-primary" href="{{ route('user.edit', ['user' => Auth::user()]) }}">{{ __('Edit') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
