@extends('layouts.bagel')
@section('content')
@include('funnel::includes._update_funnel_modal')
@include('funnel::includes._add_page_modal')
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Funnels/{{$funnel->title}}</li>
</ol>
<div class="row">
        <a href="#"  data-toggle="modal" data-target="#addpage" class="btn btn-link">
            Add External Page
        </a>
        <a href="#" data-toggle="modal" data-target="#createpost" class="btn btn-link">
            Update Funnel
        </a>
        <a  class="btn btn-link" href="{{ empty($funnel->user->wp_site) ? "#" : url($funnel->user->wp_site.config('wp_settings.create_page')) }}" target="_blank">
            Create Page from your wordpress site
        </a>
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
                    <th>WP Page ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Link</th>
                    <th>Type</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                    <tr>
                        <td>{{ $page->id }}</td>
                        <td>{{ $page->page_id }}</td>
                        <td>{{ $page->title }}</td>
                        <td>{{ $page->description }}</td>
                        <td>{{ $page->link }}</td>
                        <td>{{ $page->type }}</td>
                        <td>
                            <a href="#" class="btn btn-sm {{ in_array($page->id, $funnel_pages, true) ? 'btn-danger' : 'btn-success' }}" onclick="document.getElementById('funnel-attach-page-{{$page->id}}').submit()">
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
