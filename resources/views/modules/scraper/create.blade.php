@extends('layouts.scraper')
@section('title', 'Optin Maximizer')
@section('style')
<style type="text/css">
  input[type="radio"] {
      margin-right: 6px;
  }
</style>
@endsection('style')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="/scraper">Events</a>
    </li>
    <li class="breadcrumb-item active">Create Event</li>
</ol>
<h1>Event</h1>
<br>
<form id="workshop_form" style="position: relative;">
  {!! csrf_field() !!}
  <div class="form-group">
    <label for="event_name">Event Name</label>
    <input type="text" style="position: relative;" id="event_name" data-parsley-required="true" data-parsley-trigger="keyup" class="form-control" name="event_name" placeholder="Enter Event Name">
  </div>
  <div class="form-group">
    <label for="event_location_date">Select Location & Date</label>
    <select class="form-control" data-parsley-required="true" data-parsley-trigger="change" name="event_location_date" id="event_location_date">
      <option value="">Location & Date</option>
      @foreach($lists as $list)
        <option value="{{ $list['link'] .'|'. $list['display_name'] .'|'. $list['display_date']}}">{{$list['display_name'] .' ' . $list['display_date']}}</option>
      @endforeach
    </select>
  </div>
  <input type="hidden" id="event_form" data-parsley-required="true" name="event_form">
  <input type="hidden" id="event_tag" data-parsley-required="true" name="event_tag">
</form>
<h2 class="hide" id="preview-only">Preview Only</h2>
<div id="scrape_display">

</div>
<div id="scrape_data" hidden="">
  
</div>
<button type="button" id="btn-save-workshop" disabled class="btn btn-primary pull-right">Save</button>
<br>
@endsection
@section('script')
    <script type="text/javascript">
      var workshop_config       = {!! $workshop_config !!};
      $("#event_location_date").on('change', function () {

        var viewTab               = $('#page-top');
        var loader_image_bar_obj  = $('.loader-image-bar');

        viewTab.find('.tab-content').append(loader_image_bar_obj[0].outerHTML);
        viewTab.find('.loader-image-bar').removeClass('hide');

        $.ajax({
            type: 'post',
            url: workshop_config.scrape,
            cache: false,
            data: $('#workshop_form').serialize(),
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

                  swal("Oops! Something went wrong", 'Failed to submit.', "error");
            },

            success: function (data) {
              // if data is a error specific message
              if (typeof data.error !== 'undefined' && data.error) {
                swal("Oops! Something went wrong", data.error, "error");
                return;
              }
              $('#preview-only').removeClass('hide');
              $("#scrape_data").html('');
              $("#scrape_data").append(data.data_result);

              $("#scrape_display").html('');
              $("#scrape_display").append(data.display_result);
              $('.loader-image-bar').addClass('hide');
              $("#btn-save-workshop").prop("disabled", false);
              $("#event_form").val(data.display_result);
              $("#event_tag").val($('input[name="tags"]').val());
            }
          });
      });

      $("#btn-save-workshop").on('click', function() {

          var isValid = $("#workshop_form").parsley();

           if( !isValid.validate())
            return;

          //loading
          var viewTab               = $('#page-top');
          var loader_image_bar_obj  = $('.loader-image-bar');

          viewTab.find('.tab-content').append(loader_image_bar_obj[0].outerHTML);
          viewTab.find('.loader-image-bar').removeClass('hide');

          $.ajax({
            type: 'post',
            url: workshop_config.store_event,
            cache: false,
            data: $('#workshop_form').serialize(),
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

                  swal("Oops! Something went wrong", 'Failed to submit.', "error");
            },

            success: function (data) {
              $('.loader-image-bar').addClass('hide');
              // if data is a error specific message
              if (typeof data.error_message !== 'undefined' && data.error_message) {
                swal("Oops! Something went wrong", data.error_message, "error");
                return;
              }

              setTimeout(function() {
                window.location.replace("/scraper");
              }, 1000);

              swal("Good job!", data.msg, "success");
            }
          });
      });

    </script>
@endsection
