@extends('layouts.main')
@section('content')
<div class="card card-login mx-auto mt-5">
    <div class="card-header">
        Product List
    </div>
    <div class="card-body">
        <div class="list-group">
            <a href="{{ url('/client') }}" class="list-group-item">Modal</a>
            <a href="{{ url('/scraper')}}" class="list-group-item">Sraper</a>
        </div>
    </div>
</div>
@endsection
