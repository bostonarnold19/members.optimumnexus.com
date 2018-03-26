@extends('layouts.bagel')
@section('content')
@include('funnel::includes._update_funnel_modal')
@include('funnel::includes._add_page_modal')
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Funnels/{{$funnel->title}}</li>
</ol>
<div class="row">
    <div class="col-md-4">
        <a href="#"  data-toggle="modal" data-target="#addpage">
            <div class="well">
                <i class="fa fa-book fa-4x fa-fw" aria-hidden="true"></i>
                <div class="text">
                    <h3>Add Pages</h3>
                    <p>Total funnel page(s) : {{ $funnel->pages()->count() }}</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="#" data-toggle="modal" data-target="#createpost">
            <div class="well">
                <i class="fa fa-filter fa-4x fa-fw" aria-hidden="true"></i>
                <div class="text">
                    <h3>Update Funnel</h3>
                    <p>#</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ empty($funnel->user->wp_site) ? "#" : $funnel->user->wp_site }}" target="_blank" onclick="open(this.href, '_blank', '...'); return false;">
            <div class="well">
                <i class="fa fa-plus fa-4x fa-fw" aria-hidden="true"></i>
                <div class="text">
                    <h3>Create Page</h3>
                    <p>#</p>
                </div>
            </div>
        </a>
    </div>
</div>
<button class="btn btn-danger" style="float: right;" form="funnel-delete" type="submit">Delete Funnel</button>
<form id="funnel-delete" onsubmit="return confirm('Do you want to delete this data?');" method="POST" action="{{ route('funnel.destroy', $funnel->id) }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>
<h1>Funnel: {{$funnel->title}}</h1>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table" id="datatable">
                <thead>
                    <th>ID</th>
                    <th>Page ID (wordpress)</th>
                    <th>Title</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                    <tr>
                        <td>{{ $page->id }}</td>
                        <td>{{ $page->page_id }}</td>
                        <td>{{ $page->title }}</td>
                        <td>
                            <a href="#" class="btn {{ in_array($page->id, $funnel_pages, true) ? 'btn-danger' : 'btn-success' }}" onclick="document.getElementById('funnel-attach-page-{{$page->id}}').submit()">
                                {{ in_array($page->id, $funnel_pages, true) ? 'Detach' : 'Attach' }}
                            </a>
                            <form id="funnel-attach-page-{{$page->id}}" method="POST" action="{{ route('funnel.attach_page', $page->id) }}">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $funnel->id }}" name="funnel_id">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        <br>
    </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function(){
$('#datatable').DataTable();
});
</script>
@endsection
@section('style')
<style type="text/css">
.text {
display:inline-block;
}
.well {
min-height: 20px;
padding: 19px;
margin-bottom: 20px;
background-color: #f5f5f5;
border: 1px solid #e3e3e3;
border-radius: 4px;
-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
}
</style>
@endsection
