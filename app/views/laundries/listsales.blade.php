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
        <div style="margin-right: 100px; display:none">
            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        @include('sidebar')
    </nav>
    <div id="page-wrapper" style="background-color:#fff">
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}">Home</a></li>
            <li><a href="{{ url('laundry/salesEditAction')}}">Sales Laundry Lists</a></li>
            <li class="active">Sales Laundry list</li>
        </ol>
        <div class="row">
          <form class="form-inline">
            <p>Sales Full Name : <input type="text" style="width:356px" id="guest" class="form-control" /> <button id="go" type="button" class="btn btn-primary"> GO </button></p>
        </form>
          </div>
        <div class="row">
            <div class="span2">
                <div class="salesform">

                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('#go').on('click',function(){
   var salesName= $('#guest').val();
    if(salesName===''){
     alert("Enter the Name of the Customer first");
    }else{
        var url="<?php echo url('customerForm');?>";
        $.get(url,{name:salesName},function(data){
            $('.salesform').html(data);
        });
    }
});
</script>
@stop
