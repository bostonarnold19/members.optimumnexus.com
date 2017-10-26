@extends('layouts.dashboard')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">My Dashboard</li>
</ol>
<h1>Clients</h1>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
            <tr>
                <td>{{$client->first_name}}</td>
                <td>{{$client->last_name}}</td>
                <td>{{$client->email}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
