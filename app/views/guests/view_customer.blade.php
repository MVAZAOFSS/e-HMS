@extends('layout.master')
@section('content')
<div id="wrapper">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="navbar-header">
<a class="navbar-brand visible-lg" href="{{url("/home")}}">
  <p style="color: #000">GREENLIGHT HOTEL  </p>
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
            <li class="active">Guest Restaurant bills</li>
            <li><a href="{{ url("guest_barbills/".$id) }}">Guest Bar bills</a></li>
            <li><a href="{{ url("guest_laundrybills/".$id) }}"> Guest Laundry bills</a></li>
        </ol>
    <div class="col-lg-7">
    <table class="table table-condensed table-striped" id="den">
        <thead><tr><th>Guest name</th><th>Date of taking food</th><th>Status</th></tr></thead>
        <tbody>
            @foreach($res as $row)
            @if($row->cleared='no')
            <tr><td>{{Guest::find($row->guestid)->lastname}} {{Guest::find($row->guestid)->firstname}}</td>
                <td>{{$row->date}}</td><td><button class="btn btn-danger btn-xs" onclick="incompleteRestaurant('{{$row->id}}')"><span class="glyphicon glyphicon-share"></span> Incomplete</button></td></tr>
            @else
            <tr><td>{{Guest::find($row->guestid)->lastname}} {{Guest::find($row->guestid)->firstname}}</td>
                <td>{{$row->date}}</td><td><label class="label label-info">Complete</label></td></tr>
            @endif
            @endforeach
        </tbody>
    </table>
    </div>
    <div class="col-lg-5">
        <div class="main"></div>
    </div>
    <script>
$(document).ready(function (){
   $("#den").dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
       });
});
</script>
</div>
</div> 
<script>
    function incompleteRestaurant(id){
    var urla="<?php echo url('restaurants');?>";
    var urla2=urla+'/'+id;
    $.get(urla2,function(data){
        $('.main').html(data);
    });
}
</script>
@stop

