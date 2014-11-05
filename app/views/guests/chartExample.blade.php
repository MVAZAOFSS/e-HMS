@extends('layout.master')
@section('content')
<div id="wrapper">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand visible-lg" href="{{url("/home")}}">
            <p style="color: #000">Checkout browser</p>
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
            <li class="active">Checkouts today</li>
            <li><a href="{{ url("guest") }}"> Guests</a></li>
            <li><a href="{{ url("guest/add") }}"> Guest register</a></li>
        </ol>
        <div class=" col-lg-7">
            <div id="main_area"></div>
        </div>
      </div>
 </div>
<script>
   $(function(){
       $('#main_area').highcharts(
           {{json_encode($chartArray)}}
       )
   });
</script>
@stop
