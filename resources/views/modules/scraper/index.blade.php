@extends('layouts.scraper')
@section('title', 'WorkShop')
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js">
<link href="{{ asset('css/modalx.css') }}" rel="stylesheet">
@endsection
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Events</li>
</ol>
<div class="row">
	<div class="col-sm-12">
		<a class="btn btn-link pull-right" id="create_event" href="{{route('scraper.create.event')}}">Create Event</a>	
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
		        		<td>{!!view('scraper::actions', ['id'=>$event->id])->render()!!}</td>
		        	</tr>
		        	@endforeach
		        @endif
		    </tbody>
		</table>
	</div>
</div>
<div id="modalx-slideDown" class="body-modalx" style="width: 100%;">
	<h3 class="text-center"><i class="fa fa-cube"></i><br><span class="txt-destaque1">ModalX</span><hr></h3>
		<form>
			<div class="container">
				<input type="hidden" name="tags" id="tags">
				<input type="hidden" name="affiliate" id="affiliate">
				<div class="form-group row">
				  <label for="first_name" class="col-3 col-form-label">First Name</label>
				  <div class="col-9">
				    <input class="form-control" type="text" name="first_name" id="first_name" placeholder="Enter First Name">
				  </div>
				</div>
				<div class="form-group row">
				  <label for="last_name" class="col-3 col-form-label">Last Name</label>
				  <div class="col-9">
				    <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Enter Last Name">
				  </div>
				</div>
				<div class="form-group row">
				  <label for="email" class="col-3 col-form-label">Email</label>
				  <div class="col-9">
				    <input class="form-control" type="text" name="email" id="email" placeholder="Enter Email">
				  </div>
				</div>
				<div class="form-group row">
				  <label for="mobile_number" class="col-3 col-form-label">Mobile Number</label>
				  <div class="col-9">
				    <input class="form-control" type="text" name="mobile_number" id="mobile_number" placeholder="Mobile Number">
				  </div>
				</div>
				<br>
				<p class="h5"><small class="text-muted">Choose Your Most Convenient Session:</small></p>
				<div class="row">
					<div class="col">
						<div id="session_div">

						</div>
					</div>

				</div>
			</div>
		</form>
	<br>
	<button type="button" class="modalx-slideDown_close  btn btn-outline-secondary">Close</button>
	<button type="button" class="btn btn-outline-primary pull-right" disabled>Submit</button>
</div>
@endsection
@section('script')
	<script src="{{ asset('js/modalx.js') }}"></script>
	<script type="text/javascript">

		//load modal
		$('#modalx-slideDown').popup();

		//routes
		var workshop_config       = {!! $workshop_config !!};

		//for loading 
		var viewTab               = $('#page-top');
	    var loader_image_bar_obj  = $('.loader-image-bar');

		$("#create_event").on('click', function (){
	        viewTab.find('.tab-content').append(loader_image_bar_obj[0].outerHTML);
	        viewTab.find('.loader-image-bar').removeClass('hide');
		});

	 	$('#events_table').DataTable({
       		columnDefs: [
			   { orderable: false, targets: -1 }
			]
       	});
       	$(".btn-modal").on('click', function () {
       		
       		console.log('asd');
	        viewTab.find('.tab-content').append(loader_image_bar_obj[0].outerHTML);
	        viewTab.find('.loader-image-bar').removeClass('hide');

	        var id = $(this).data('id');
	        var route = workshop_config.get_event.replace('@id', id);
	        $.ajax({
	          type: 'get',
	          url: route,
	          cache: false,
	          dataType: 'json',
	          error: function (jqXHR, textStatus, errorThrown) {
	            $('.loader-image-bar').addClass('hide');
	            if (textStatus != 'error')
	                  return;

	                if (errorThrown == 'Unprocessable Entity'){

	                  var responseJSON = jqXHR.responseJSON;

	                  try {
	                    swal("Oops! Something went wrong", responseJSON[Object.keys(responseJSON)[0]][0], "error");
	                    return;
	                  } catch (e) {
	                    // do nothing
	                  }
	                }

	                swal("Oops! Something went wrong", 'Failed to view event.', "error");
	          },

	          success: function (data) {
	            $('#session_div').html(data.html);
	            $('.loader-image-bar').addClass('hide');
	          }
	        });
	      });
    </script>
@endsection
