@extends('layouts.dashboard')
@section('title', 'IMF | Workshop')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Home</a>
    </li>
    <li class="breadcrumb-item active">IMF Workshop</li>
</ol>
<form>
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
