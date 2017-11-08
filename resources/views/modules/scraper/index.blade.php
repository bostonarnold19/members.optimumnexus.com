@extends('layouts.scraper')
@section('title', 'WorkShop')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Scraper</a>
    </li>
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
<h1>Scraper</h1>
<br>
@if(isset($user_workshop->id))
    <a class="pull-right" target="_blank" href="{{route('user.workshop',['id' => $user_workshop->id, 'custom_url' => $user_workshop->custom_url])}}">View Workshop</a>
@endif
<form id="workshop_form">
  {!! csrf_field() !!}
  <input type="hidden" id="workshop_id" value="{{@$user_workshop->id}}">
  <div class="form-group">
    <label for="custom_url">Custom URL</label>
    <input type="custom_url" value="{{ @$user_workshop->custom_url }}" id="custom_url" data-parsley-required="true" data-parsley-trigger="keyup" class="form-control" name="custom_url"  aria-describedby="customUrlHelp" placeholder="Enter your custom url">
    <small id="customUrlHelp" class="form-text text-muted">(i.e my-custom-url)</small>
  </div>

  <div class="form-group">
    <label>IMF URL</label>
    <input type="imfurl" value="{{ @$user_workshop->imfurl }}" class="form-control" data-parsley-required="true" data-parsley-trigger="keyup" name="imfurl" placeholder="http://imfreedomworkshop.com/">
  </div>

  <div class="form-group">
    <label>Phone</label>
    <input type="text" value="{{ isset($user_workshop->phone) && $user_workshop->phone  ? $user_workshop->phone : '(999)999-9999' }}" class="form-control" data-parsley-required="true" data-parsley-trigger="keyup" name="phone" placeholder="(999)999-9999">
  </div>

  <div class="form-group">
    <label>Address 1</label>
    <input type="text" value="{{ isset($user_workshop->address_1) && $user_workshop->address_1  ? $user_workshop->address_1 : '123 Main Avenue' }}" class="form-control" data-parsley-required="true" data-parsley-trigger="keyup" name="address_1" placeholder="123 Main Avenue">
  </div>

  <div class="form-group">
    <label>City</label>
    <input type="text" value="{{ isset($user_workshop->city) && $user_workshop->city  ? $user_workshop->city : 'London' }}" class="form-control" data-parsley-required="true" data-parsley-trigger="keyup" name="city" placeholder="London">
  </div>

  <div class="form-group">
    <label>Zip Code</label>
    <input type="text" value="{{ isset($user_workshop->zip_code) && $user_workshop->zip_code  ? $user_workshop->zip_code : '12345' }}" class="form-control" data-parsley-required="true" data-parsley-trigger="keyup" name="zip_code" placeholder="12345">
  </div>

  <button type="button" id="btn-save-workshop" class="btn btn-primary pull-right">Save</button>

</form>
@endsection
@section('script')
    <script type="text/javascript">
      // $('#custom_url').on('keyup',function () {
      //     var slug_url = $(this).val();
      //     $(this).val(slugify(slug_url));

      // });

        $("#btn-save-workshop").on('click', function() {

            var isValid = $("#workshop_form").parsley();

             if( !isValid.validate())
              return;

            //loading
            var viewTab               = $('#workshop_div');
            var loader_image_bar_obj  = $('.loader-image-bar');

            viewTab.find('.tab-content').append(loader_image_bar_obj[0].outerHTML);
            viewTab.find('.loader-image-bar').removeClass('hide');

            var workshop_config       = {!! $workshop_config !!};
            var method_action         = 'post';
            var method_url            = workshop_config.store;
            var workshop_id           = $('#workshop_id').val();

            if (workshop_id != '') {
              method_url = workshop_config.update.replace('@id', workshop_id);
              method_action = 'put';
            }
            console.log(method_url);
            $.ajax({
              type: method_action,
              url: method_url,
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
                    location.reload(true);
                }, 1000);

                swal("Good job!", data.msg, "success");
              }
            });
        });

    </script>
@endsection
