@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">

        <h3>Routes: <span class="badge badge-success">Api</span></h3>
        <div class="col-lg-12">
<ul class="list-group">
    <li class="list-group-item">Route: api/register</li>
    <li class="list-group-item">Route: api/login</li>
    <li class="list-group-item">Route: api/logout</li>
    <li class="list-group-item">Route: api/cities</li>
    <li class="list-group-item">Route: api/users</li>
    <li class="list-group-item">Route: api/events</li>
    <li class="list-group-item">Route: api/events/{event}/show</li>
    <li class="list-group-item">Route: api/events/{event}/delete</li>
    <li class="list-group-item">Route: api/participants</li>
    <li class="list-group-item">Route: api/participants/store</li>
    <li class="list-group-item">Route: api/participants/{participant}/update</li>
    <li class="list-group-item">Route: api/participants/{participant}/delete</li>
    <li class="list-group-item">Route: api/participants/{participant}/show</li>

</ul>
        </div>
    </div>
</div>
@endsection
