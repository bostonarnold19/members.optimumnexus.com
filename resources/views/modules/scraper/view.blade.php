@extends('layouts.scraper')
@section('title', 'WorkShop')
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
		            <th width="40%">Date & Location</th>
		            
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
		    	<tr>
			        <td>Juan Dela Cruz</td>
			        <td>12:30pm</td>
			        <td>Tuesday, Nov 28, 2017 heraton Melbourne Hotel 27 Little Collins Street Melbourne, VIC 3000</td>
			    </tr>
			    <tr>
			        <td>Jon Doe</td>
			        <td>6:00pm</td>
			        <td>Tuesday, Nov 28, 2017 heraton Melbourne Hotel 27 Little Collins Street Melbourne, VIC 3000</td>
			    </tr>
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
