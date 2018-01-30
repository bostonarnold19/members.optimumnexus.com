@extends('layouts.main')
@section('content')
<div class="card card-login mx-auto mt-5">
    <div class="card-header">
        Product List
    </div>
    <div class="card-body">
        <div class="list-group">
            <a href="{{ url('/sw2') }}" class="list-group-item">Site Wrap 2.0</a>
            <a href="{{ url('/om')}}" class="list-group-item">Optin Maximizer</a>
        </div>
        <hr>
        <form action="{{ route('logout') }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" class="form-control btn btn-danger">Logout</button>
        </form>
    </div>
</div>
@endsection
