@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('userProfile') }}">
    @csrf
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="firstname">Name</label>
                <input type="text" class="form-control" required name="name" value="{{ Auth::user()->name }}">
            </div>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="company">E-Mail Address</label>
                <input type="text" class="form-control" required readonly name="email"
                    value="{{ Auth::user()->email }}">
            </div>
        </div>

    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="city">Phone Number</label>
                <input type="text" class="form-control" name="phonenumber" value="{{ Auth::user()->phonenumber }}">
            </div>
            @error('phonenumber')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!-- <div class="col-sm-6">
            <div class="form-group">
                <label for="phone">Date Of Birth</label>
                <input type="date" class="form-control" id="phone" name="dateofbirth"
                    value="{{ date("Y-m-d", strtotime(Auth::user()->dateofbirth)) }}">
            </div>
        </div> -->

        <div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-template-main"><i class="fa fa-save"></i> Save
                changes</button>

        </div>

    </div>

</form>
@endsection