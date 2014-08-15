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
            <li class="active">Today Store report</li>                    
        </ol>
        <div style="font-size: 15px ;padding: 10px; margin:0px 20px; height: 440px; overflow: auto">
            <p>
              <input type="text" id="tday" style="width:240px; padding: 7px; border-radius: 6px; border:1px solid black" placeholder="Enter date " class="" value="{{date('Y-m-d')}}"/>
              <button type="button" class="btn btn-primary" id="go"> Go</button>
            </p>
            <hr/>

            <p id="loader" style="display:none"><img src="{{url("img/load.gif")}}" /> Loading ...</p>  
            <div id="report"></div> 
            
        </div>
</div>  
<script type="text/javascript">
  $(document).ready(function(){

    function loadreport(date){

        $('#report').html("");
        $('#loader').show();
        $.post('getreport',{d:date},function(data){
            $('#loader').hide();
            $('#report').html(data);
        });
    }

    $('#tday').datepicker({ dateFormat: "yy-mm-dd"});

    $('#go').on('click', function(){
          var date = $('#tday').val();
          alert(2)
          //loadereport(date);
    });

  });
</script>
@stop