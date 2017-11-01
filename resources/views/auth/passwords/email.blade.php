@extends('layouts.main')
@section('content')
<div class="card card-login mx-auto mt-5">
    <div class="card-header">
        Reset Password
    </div>
    <div class="card-body">
        <div class="text-center mt-4 mb-5">
            <h4>Forgot your password?</h4>
            <p>Enter your email address and we will send you instructions on how to reset your password.</p>
        </div>
        <form>
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address">
            </div>
            <a class="btn btn-primary btn-block" href="#">Reset Password</a>
        </form>
        <br>
        <div>
            <a class="d-block small" href="{{ route('login') }}">Login Page</a>
        </div>
    </div>
</div>
@endsection
