@extends('layouts.bagel')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Category</a>
    </li>
    <li class="breadcrumb-item active"></li>
</ol>
<h1>Categories</h1>
<br>
<a href="#" class="btn btn-success" data-toggle="modal" data-target="#createpost">Add new category</a>
<br>
<br>
<div class="table-responsive">
    <table class="table" id="datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->description}}</td>
                <td>
                    <a style="color:white;" class="btn btn-warning" href="{{ route('category-bagel.edit', $category->id) }}">
                        Edit
                    </a>
                    <form style="display:inline;" onsubmit="return confirm('{{config('kog3nt.onsubmit_msg')}}');" method="POST" action="{{ route('category-bagel.destroy', $category->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('category_bagel::includes._modal_add')
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#datatable').DataTable();
    });
</script>
@endsection
