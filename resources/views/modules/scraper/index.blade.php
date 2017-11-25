@extends('layouts.scraper')
@section('title', 'WorkShop')
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js">
@endsection
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Events</li>
</ol>
<div class="row">
	<div class="col-sm-12">
		<a class="btn btn-link pull-right" href="{{route('scraper.create.event')}}">Create Event</a>	
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<table id="events_table" class="table table-striped table-bordered" width="100%" cellspacing="0">
		    <thead>
		        <tr>
		            <th>Event Name</th>
		            <th>Event Location</th>
		            <th>Event Date</th>
		            <th class="no-sort">Action</th>
		        </tr>
		    </thead>
		    <tfoot>
		        <tr>
		            <th>Event Name</th>
		            <th>Event Location</th>
		            <th>Event Date</th>
		            <th>Action</th>
		        </tr>
		    </tfoot>
		    <tbody>
		        @if($user_events)
		        	@foreach($user_events as $event)
		        	<?php $event_location = explode('|',$event->event_location_date); ?>
		        	<tr>
		        		<td>{{$event->event_name}}</td>
		        		<td>{{$event_location[1]}}</td>
		        		<td>{{$event_location[2]}}</td>
		        		<td>{!!view('scraper::actions')->render()!!}</td>
		        	</tr>
		        	@endforeach
		        @endif
		    </tbody>
		</table>
	</div>
</div>
@endsection
@section('script')
    <script type="text/javascript">
       $('#events_table').DataTable({
       		columnDefs: [
			   { orderable: false, targets: -1 }
			]
       	});
    </script>
@endsection
