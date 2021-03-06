@extends('layouts.main')
@section('content')
<div class="card card-login mx-auto mt-5">
    <div class="card-header">
        Login
    </div>
    <div class="card-body">
        <form action="{{ route('login') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <button class="btn btn-primary btn-block" type="submit">Login</button>
        </form>
        <br>
        <div>
            <a class="d-block small" href="{{ route('password.request') }}">Forgot Password?</a>
        </div>
    </div>
</div>
@endsection
