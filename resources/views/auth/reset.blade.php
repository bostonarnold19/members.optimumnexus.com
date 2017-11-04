@extends('layouts.main')
@section('content')
<div class="card card-login mx-auto mt-5">
    <div class="card-header">
        Reset Profile
    </div>
    <div class="card-body">
        <form action="{{ route('patch.user.update-credentials') }}" method="POST">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PATCH">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
            </div>
            <div class="form-group">
                <label for="middle_name">Middle Name</label>
                <input type="text" class="form-control" id="lastmiddle_name_name" name="middle_name" placeholder="Middle Name">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
            </div>
            <button class="btn btn-primary btn-block" type="submit">Update</button>
        </form>
        <br>
    </div>
</div>
@endsection
