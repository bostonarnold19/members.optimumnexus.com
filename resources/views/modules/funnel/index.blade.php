@extends('layouts.bagel')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Funnels</li>
</ol>
<div class="row">
    <div class="col-md-4">
        <a href="#" data-toggle="modal" data-target="#createpost">
            <div class="well">
                <i class="fa fa-filter fa-4x fa-fw" aria-hidden="true"></i>
                <div class="text">
                    <h3>Create Funnel</h3>
                    <p>#</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="#" data-toggle="modal" data-target="#wpsiteupdate">
            <div class="well">
                <i class="fa fa-globe fa-4x fa-fw" aria-hidden="true"></i>
                <div class="text">
                    <h3>Update Wp Site</h3>
                    <p>#</p>
                </div>
            </div>
        </a>
    </div>
</div>
@include('funnel::includes._add_funnel_modal')
@include('funnel::includes._update_wp_site_modal')
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
