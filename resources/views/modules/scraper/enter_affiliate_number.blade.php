@extends('layouts.scraper')
@section('style')
    <style type="text/css">
        .parsley-errors-list {
            top: 40px ;
        }
    </style>
@endsection
@section('content')
<div class="card card-login mx-auto mt-5">
    <div class="card-header">
        Enter Affiliate number
    </div>
    <div class="card-body">
        <form id="affiliate_form" method="post" action="{{route('scraper.affiliate')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" id="affiliate_number" data-parsley-required="true" data-parsley-trigger="keyup" class="form-control" name="affiliate_number"  aria-describedby="affiliate_number" placeholder="Enter your Affiliate Number">
                <small id="affiliate_number" class="form-text text-muted">(i.e 14231241)</small>
            </div>
            <button type="button" id="btn-save-affiliate" class="form-control btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
@section('script')
    <script type="text/javascript">
        $("#btn-save-affiliate").on('click', function() {
            var isValid = $("#affiliate_form").parsley();

             if( !isValid.validate())
              return;
            $('#affiliate_form').submit();
        });
    </script>
@endsection
