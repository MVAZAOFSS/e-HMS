@extends('layout.master')
@section('content')
<div id="wrapper">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="navbar-header">
<a class="navbar-brand visible-lg" href="{{url("/home")}}">
	<p style="color: #000">Hotel administration</p>
</a>
<a class="navbar-brand hidden-lg" href='#'>
	 <p>EMIS</p>
</a>
</div>
@include('layout-setup')
@include('sidebar')
</nav>

<div id="page-wrapper" style="background-color:#fff">
<ol class="breadcrumb">
            <li><a href="{{ url('home') }}">Home</a></li>
            <li><a href="{{url("reports/rooms")}}">Rooms reports </a></li>
            <li class="active">Canceled rooms report </li>
                           
</ol>
<hr/>
<div class="col-lg-12">
    <table class="table table-condensed table-striped" id="cancel">
        <thead><tr><th>Name</th><th>Order from</th><th>Order to</th><th>Phone number</th><th>Room</th></tr></thead>
        <tbody>
            @foreach($order as $row)
            <tr><td>{{$row->lastname}}  {{$row->firstname}}</td><td>{{$row->arrival_date}}</td><td>{{$row->departure_date}}</td>
                <td>{{$row->mobile}}</td><td>{{Room::find($row->room_number)->name}}</td></tr>     
            @endforeach
        </tbody>
    </table>
</div>
<script>
    $("#cancel").dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
</script>
@stop