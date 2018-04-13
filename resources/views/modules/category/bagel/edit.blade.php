@extends('layouts.bagel')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Category</a>
    </li>
    <li class="breadcrumb-item active">{{ $category->name }}</li>
</ol>
<h1>Edit Category</h1>
<br>
<div class="row">

    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form onsubmit="return confirm('Do you want to save this data?');" method="POST" action="{{ route('category-bagel.update', $category->id) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group">
                <label for="title">Name</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ $category->name }}" required autofocus>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description">{{ $category->description }}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success form-control">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
