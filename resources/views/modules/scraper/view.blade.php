@extends('layouts.scraper')
@section('title', 'Optin Maximizer | View')
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js">
@endsection
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="/scraper">Events</a>
    </li>
    <li class="breadcrumb-item active">View Event</li>
</ol>
<div class="row">
	<div class="col-sm-12">
		<table id="attendees" class="table table-striped table-bordered" width="100%" cellspacing="0">
		    <thead>
		        <tr>
		            <th width="40%">Name</th>
		            <th width="20%">Time</th>
		            <th width="40%">Date</th>
		            
		        </tr>
		    </thead>
		    <tfoot>
		        <tr>
		            <th>Name</th>
		            <th>Time</th>
		            <th>Date & Location</th>
		        </tr>
		    </tfoot>
		    <tbody>
		    	@if($attendees)
		    		@foreach($attendees as $attendee)
		    			<?php
		    				$date_time = explode(';',$attendee->time);
		    			?>
		    			<tr>
		    				<td>{{$attendee->first_name . ' ' . $attendee->last_name}}</td>
		    				<td>{{$date_time[0]}}</td>
		    				<td>{{$date_time[1]}}</td>
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
       $('#attendees').DataTable();
    </script>
@endsection
