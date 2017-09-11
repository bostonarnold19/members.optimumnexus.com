@extends('layouts.main')
@section('content')
<div class="card card-register mx-auto mt-5">
    <div class="card-header">
        Register an Account
    </div>
    <div class="card-body">
        <form>
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="first_name">First name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name">
                    </div>
                    <div class="col-md-6">
                        <label for="last_name">Last name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password_confirmation" placeholder="Password">
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation">Confirm password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
                    </div>
                </div>
            </div>
            <a class="btn btn-primary btn-block" href="#">Register</a>
        </form>
        <div class="text-center">
            <a class="d-block small mt-3" href="{{ route('login') }}">Login Page</a>
            <a class="d-block small" href="{{ route('password.request') }}">Forgot Password?</a>
        </div>
    </div>
</div>
@endsection
